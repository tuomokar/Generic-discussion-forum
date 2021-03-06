<?php

class Post extends BaseModel {

    public $id, $message, $created, $edited, $userId, $threadId, $creator, $creatorId, $thread, $numberInThread, $threadName;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    /*
     * Fetches all the info of a given post. Besides the info that is on the 'post' table in the database, also
     * the post's creator's username and the name of the thread that the post is in are added to the Post object
     * the method returns. Note that for the message of the post the line breaks are changed to br elements so that
     * the line breaks can be rendered correctly.
     */
    public static function find($id) {
        $query = DB::connection() -> prepare('SELECT p.id, p.message, p.created, p.edited, p.user_id, u.username AS creator, p.thread_id, t.title AS thread
                                                FROM post p, forum_user u, thread t
                                                  WHERE p.id = :id AND p.user_id = u.id AND p.thread_id = t.id');
        $query -> execute(array('id' => $id));

        $row = $query -> fetch();

        if (!$row) {
            return null;
        }

        return new Post(array(
            'id' => $id,
            'message' => nl2br($row['message']),
            'created' => date('d-m-Y H:i:s', strtotime($row['created'])),
            'edited' => $row['edited'] ? date('d-m-Y H:i:s', strtotime($row['edited'])) : '',
            'creatorId' => $row['user_id'],
            'threadId' => $row['thread_id'],
            'creator' => $row['creator'],
            'thread' => $row['thread']
        ));
    }

    public static function fetchIdAndMessage($id) {
        $query = DB::connection() -> prepare('SELECT id, message FROM post WHERE id = :id');
        $query -> execute(array('id' => $id));

        $row = $query -> fetch();

        if (!$row) {
            return null;
        }

        return new Post(array(
            'id' => $id,
            'message' => $row['message']
        ));
    }

    public function save() {
        $query = DB::connection() -> prepare('INSERT INTO post (user_id, thread_id, message, created)
                                                VALUES (:userId, :threadId, :message, now())');
        $query -> execute(array('userId' => $this -> userId, 'threadId' => $this -> threadId, 'message' => $this -> message));
    }

    public function update() {
        $query = DB::connection() -> prepare('UPDATE post SET message = :message, edited = now() WHERE id = :id RETURNING thread_id');
        $query -> execute(array('id' => $this -> id, 'message' => $this -> message));

        $this -> setThreadId($query);
    }

    // if the post was the first one and thus also the thread is deleted, returns the post's thread's topic group id
    // otherwise returns null
    public function destroy() {
        $topicGroupId = $this -> deleteThreadIfFirstPost();
        $query = DB::connection() -> prepare('DELETE FROM post WHERE id = :id RETURNING thread_id');
        $query -> execute(array('id' => $this -> id));

        $this -> setThreadId($query);

        return $topicGroupId;
    }

    private function deleteThreadIfFirstPost() {
        $query = DB::connection() -> prepare('SELECT p.id, p.thread_id, t.topic_group_id FROM thread t, post p WHERE t.id = p.thread_id AND t.id = (SELECT thread_id FROM post WHERE id = :id) LIMIT 1');
        $query -> execute(array('id' => $this -> id));

        $row = $query -> fetch();
        if ($this -> notThreadCreator($row)) {
            return null;
        }
        $this -> threadId = $row['thread_id'];
        $this -> removeThread($row);

        return $row['topic_group_id'];
    }

    private function notThreadCreator($row) {
        return !$row || $row['id'] != $this -> id;
    }

    private function removeThread() {
        $query = DB::connection() -> prepare('DELETE FROM thread WHERE id = :id');
        $query -> execute(array('id' => $this -> threadId));
    }

    private function setThreadId($query) {
        $row = $query -> fetch();
        $this -> threadId = $row['thread_id'];
    }

    private function validateMessage() {
        return $this -> validateFieldsExist(array('Message' => $this -> message));
    }

    private function validateIds() {
        $errors = $this -> validateFieldsExist(array('User' => $this -> userId));
        if ($errors) {
            return $errors;
        }

        $query = DB::connection() -> prepare('SELECT u.id AS user_id, t.id AS thread_id FROM thread t, forum_user u WHERE u.id = :userId');
        $query -> execute(array('userId' => $this -> userId));

        $row = $query -> fetch();

        if (!$row) {
            $errors[] = 'User must exist!';
        }

        return $errors;
    }

    public function validateWhenSaving() {
        $errors = $this -> validateIds();
        return array_merge($errors, $this -> validateMessage());
    }

    public function validateWhenUpdating() {
        return $this -> validateMessage();
    }

    public static function findCreatorId($postId) {
        $query = DB::connection() -> prepare('SELECT user_id FROM post WHERE id = :id LIMIT 1');
        $query -> execute(array('id' => $postId));

        $row = $query -> fetch();
        return $row['user_id'];
    }
}

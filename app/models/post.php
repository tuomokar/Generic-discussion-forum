<?php

class Post extends BaseModel {

    public $id, $message, $created, $edited, $userId, $threadId, $creator, $thread, $numberInThread;

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
            'created' => $row['created'],
            'edited' => $row['edited'],
            'user_id' => $row['user_id'],
            'threadId' => $row['thread_id'],
            'creator' => $row['creator'],
            'thread' => $row['thread']
            // if possible, include also the info on the number of the post within the thread here
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

    public function destroy() {
        $query = DB::connection() -> prepare('DELETE FROM post WHERE id = :id RETURNING thread_id');
        $query -> execute(array('id' => $this -> id));

        $this -> setThreadId($query);
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
}

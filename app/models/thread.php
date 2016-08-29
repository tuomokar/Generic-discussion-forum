<?php

class Thread extends BaseModel {

    public $id, $title, $created, $edited, $creator, $topicGroupId, $postCount, $group;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function find($id) {
        $query = DB::connection() -> prepare('SELECT t.id, t.title, t.topic_group_id, g.name AS group FROM thread t, topic_group g 
                                                WHERE t.id = :threadId AND t.topic_group_id = g.id');

        $query -> execute(array('threadId' => $id));
        $row = $query -> fetch();

        if (!$row) {
            return null;
        }

        return new Thread(array(
            'id' => $id,
            'title' => $row['title'],
            'topicGroupId' => $row['topic_group_id'],
            'group' => $row['group']
        ));
    }

    /*
     * Fetches all the posts of a given thread. Besides the info that is on the 'post' table in the database, also
     * the post's creator's username is added to each Post object the method returns, along with also the number of
     * the post within the thread. Note that for the message of each post the line breaks are changed to br elements
     * so that the line breaks can be rendered correctly.
     */
    public static function findPostsOfThread($threadId) {
        $query = DB::connection() -> prepare('SELECT p.id, p.message, p.created, p.edited, p.user_id, u.username AS creator FROM post p, forum_user u 
                                                WHERE thread_id = :threadId AND p.user_id = u.id ORDER BY p.id');

        $query -> execute(array('threadId' => $threadId));
        $rows = $query -> fetchAll();

        $posts = array();
        for ($i = 0; $i < sizeof($rows); $i++) {
            $row = $rows[$i];
            $posts[] = new Post(array(
                'id' => $row['id'],
                'message' => nl2br($row['message']),
                'created' => date('d-m-Y H:i:s', strtotime($row['created'])),
                'edited' => date('d-m-Y H:i:s', strtotime($row['edited'])),
                'creatorId' => $row['user_id'],
                'creator' => $row['creator'],
                'numberInThread' => $i + 1
            ));
        }

        return $posts;
    }

    public function save() {
        $query = DB::connection() -> prepare('INSERT INTO thread (title, topic_group_id, created) 
                                                VALUES(:title, :topicGroupId, CURRENT_DATE) RETURNING id');
        $query -> execute(array('title' => $this -> title, 'topicGroupId' => $this -> topicGroupId));

        $row = $query -> fetch();
        $this -> id = $row['id'];
    }

    public function update() {
        $query = DB::connection() -> prepare('UPDATE thread SET title = :title, edited = CURRENT_DATE WHERE id = :id');
        $query -> execute(array('title' => $this -> title, 'id' => $this -> id));
    }

    public function destroy() {
        $query = DB::connection() -> prepare('DELETE FROM thread WHERE id = :id RETURNING topic_group_id');
        $query -> execute(array('id' => $this -> id));

        $row = $query -> fetch();
        $this -> topipGroupId = $row['topic_group_id'];
    }

    public function validateWhenSaving() {
        return $this -> validateTitle();
    }

    private function validateTitle() {
        return $this -> validateStringLength($this -> title, 2, 50, 'Title');
    }

    public function validateWhenUpdating() {
        $errors = $this -> validateTitle();
        return array_merge($errors, $this -> validateGroupId());
    }

    private function validateGroupId() {
        $query = DB::connection() -> prepare('SELECT id FROM topic_group WHERE id = :id');
        $query -> execute(array('id' => $this -> topicGroupId));

        $row = $query -> fetch();
        if (!$row) {
            return array('Topic group must exist!');
        }
        return array();
    }

}
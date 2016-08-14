<?php

class Thread extends BaseModel {

    public $id, $title, $created, $edited, $creator, $topic_group_id, $postCount, $group;

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
            'id' => $row['id'],
            'title' => $row['title'],
            'topic_group_id' => $row['topic_group_id'],
            'group' => $row['group']
        ));
    }

    /**
     * Fetches all the posts of a given thread. Besides the info that is on the 'post' table in the database, also
     * the post's creator's username is added to each Post object the method the method returns. Note that for
     * the message of each post the line breaks are changed to br elements so that the line breaks can be rendered
     * correctly.
     * @param $threadId The id of the thread the posts are wanted from
     * @return array Array containing Post objects
     */
    public static function findPostsOfThread($threadId) {
        $query = DB::connection() -> prepare('SELECT p.id, p.message, p.created, p.edited, p.user_id, u.username AS creator FROM post p, forum_user u 
                                                WHERE thread_id = :threadId AND p.user_id = u.id');

        $query -> execute(array('threadId' => $threadId));
        $rows = $query -> fetchAll();

        $posts = array();
        foreach ($rows as $row) {
            $posts[] = new Post(array(
                'id' => $row['id'],
                'message' => nl2br($row['message']),
                'created' => $row['created'],
                'edited' => $row['edited'],
                'user_id' => $row['user_id'],
                'creator' => $row['creator'],
            ));
        }

        return $posts;
    }

    public function save() {
        $query = DB::connection() -> prepare('INSERT INTO thread (title, topic_group_id, created) 
                                                VALUES(:title, :topic_group_id, CURRENT_DATE) RETURNING id');
        $query -> execute(array('title' => $this -> title,'topic_group_id' => $this -> topic_group_id));

        $row = $query -> fetch();

        $this -> id = $row['id'];
    }

    public function update() {
        $query = DB::connection() -> prepare('UPDATE thread SET title = :title, edited = DEFAULT WHERE id = :id RETURNING id');
        $query -> execute(array('title' => $this -> title, 'id' => $this -> id));

        $row = $query -> fetch();

        $this -> id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection() -> prepare('DELETE FROM thread WHERE id = :id RETURNING topic_group_id');
        $query -> execute(array('id' => $this -> id));

        $row = $query -> fetch();

        $this -> topic_group_id = $row['topic_group_id'];
    }
}
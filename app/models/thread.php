<?php

class Thread extends BaseModel {

    public $id, $title, $created, $edited, $creator, $postCount, $group;

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
     * the post's creator's username is added to each Post object the method the method returns.
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
}
<?php

class TopicGroup extends BaseModel {

    public $id, $name, $info, $created, $edited;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection() -> prepare('SELECT * FROM topic_group');
        $query -> execute();

        $rows = $query -> fetchAll();
        $groups = array();

        foreach ($rows as $row) {
            $groups[] = new TopicGroup(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'info' => $row['info'],
                'created' => $row['created'],
                'edited' => $row['edited']
            ));
        }

        return $groups;
    }

    public static function find($id) {
        $query = DB::connection() -> prepare('SELECT * FROM topic_group WHERE id = :id LIMIT 1');
        $query -> execute(array('id' => $id));
        $row = $query -> fetch();

        if ($row) {
            $group = new TopicGroup(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'info' => $row['info'],
                'created' => $row['created'],
                'edited' => $row['edited']
            ));

            return $group;
        }
        return null;
    }

    /**
     * Finds threads of a given topic group. The thread's id, title, creator and the post count are included in every
     * thread object. To get each thread's creator, it looks up the poster of the first post in each thread.
     * @param $groupId The id of the topic group the threads are wanted from.
     * @return array|null array containing the topic group's threads, or null if there are no threads in
     * the topic group.
     */
    public static function findThreads($groupId) {
        $query = DB::connection() -> prepare('SELECT id, title FROM thread WHERE topic_group_id = :groupId');
        $query -> execute(array('groupId' => $groupId));
        $rows = $query -> fetchAll();

        if (!$rows) {
            return null;
        }

        $threads = array();
        foreach ($rows as $row) {
            $threadId = $row['id'];

            $creator = TopicGroup::getThreadCreator($threadId);
            $postCount = TopicGroup::getPostCount($threadId);

            $threads[] = new Thread(array(
                'id' => $threadId,
                'title' => $row['title'],
                'creator' => $creator,
                'postCount' => $postCount
            ));
        }

        return $threads;
    }

    private static function getThreadCreator($threadId) {
        // Optimize this! Could probably be included in the query at the start of the findThreads method
        // ..but not the easiest query to do like that
        $query = DB::connection() -> prepare('SELECT u.username AS creator FROM post p, forum_user u 
                                                    WHERE p.user_id = u.id AND p.thread_id = :threadId LIMIT 1');
        $query -> execute(array('threadId' => $threadId));
        $creatorRow = $query -> fetch();

        return $creatorRow['creator'];
    }

    private function getPostCount($threadId) {
        $query = DB::connection() -> prepare('SELECT COUNT(*) FROM post WHERE thread_id = :threadId');
        $query -> execute(array('threadId' => $threadId));
        $postCountRow = $query -> fetch();

        return $postCountRow['count'];
    }

    public function save() {
        $query = DB::connection() -> prepare('INSERT INTO topic_group (name, info, created) VALUES (:name, :info, now()) RETURNING id');
        $query -> execute(array('name' => $this -> name, 'info' => $this -> info));

        $row = $query -> fetch();

        $this -> id = $row['id'];
    }

    public function update() {
        $query = DB::connection() ->prepare('UPDATE topic_group SET name = :name, info = :info, edited = DEFAULT WHERE id = :id RETURNING id');
        $query -> execute(array('name' => $this -> name, 'info' => $this -> info, 'id' => $this -> id));

        $row = $query -> fetch();

        $this -> id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection() -> prepare('DELETE FROM topic_group WHERE id = :id');
        $query -> execute(array('id' => $this -> id));
    }

    public static function fetchIdAndName() {
        $query = DB::connection() -> prepare('SELECT id, name FROM topic_group');
        $query -> execute();

        $rows = $query -> fetchAll();

        $groups = array();
        foreach ($rows as $row) {
            $groups[] = new TopicGroup(array(
                'id' => $row['id'],
                'name' => $row['name'],
            ));
        }

        return $groups;


    }
}
<?php

class TopicGroup extends BaseModel {

    public $id, $name, $info, $created, $edited;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this -> validators = array('validateName', 'validateInfo');
    }

    public static function all() {
        $query = DB::connection() -> prepare('SELECT id, name, info FROM topic_group');
        $query -> execute();

        $rows = $query -> fetchAll();
        $groups = array();

        foreach ($rows as $row) {
            $groups[] = new TopicGroup(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'info' => $row['info']
            ));
        }

        return $groups;
    }

    public static function find($id) {
        $query = DB::connection() -> prepare('SELECT id, name, info FROM topic_group WHERE id = :id LIMIT 1');
        $query -> execute(array('id' => $id));
        $row = $query -> fetch();

        if (!$row) {
            return null;
        }

        $group = new TopicGroup(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'info' => $row['info']
        ));

        return $group;
    }

    /*
     * Finds threads of a given topic group. The thread's id, title, creator and the post count are included in every
     * thread object. To get each thread's creator, it looks up the poster of the first post in each thread.
     */
    public static function findThreads($groupId) {
        $query = DB::connection() -> prepare('SELECT id, title FROM thread WHERE topic_group_id = :groupId');
        $query -> execute(array('groupId' => $groupId));
        $rows = $query -> fetchAll();

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
        // Possible to optimize this? Not the easiest query to do though without having it in loop
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
        $query = DB::connection() ->prepare('UPDATE topic_group SET name = :name, info = :info, edited = CURRENT_DATE WHERE id = :id RETURNING id');
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

    public function validateName() {
        return $this -> validateStringLength($this -> name, 2, 50, 'Name');
    }

    public function validateInfo() {
        return $this -> validateStringLength($this -> info, 2, 400, 'Info');
    }
}
<?php

class User extends BaseModel {

    public $id, $username, $password, $info, $created, $edited, $postCount;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection() -> prepare('SELECT id, username, created FROM forum_user');
        $query -> execute();

        $rows = $query -> fetchAll();

        $users = array();
        foreach ($rows as $row) {
            $id = $row['id'];
            $users[] = new User(array(
                'id' => $id,
                'username' => $row['username'],
                'created' => $row['created'],
                'postCount' => User::countUsersPosts($id)
            ));
        }

        return $users;
    }

    private static function countUsersPosts($userId) {
        $query = DB::connection() -> prepare('SELECT count(*) FROM post WHERE user_id = :id');
        $query -> execute(array('id' => $userId));

        $countRow = $query -> fetch();

        return $countRow['count'];


    }

    public static function find($id) {
        $query = DB::connection() -> prepare('SELECT id, username, info, created FROM forum_user WHERE id = :id');
        $query -> execute(array('id' => $id));

        $row = $query -> fetch();

        if (!$row) {
            return null;
        }

        return new User(array(
            'id' => $row['id'],
            'username' => $row['username'],
            'info' => $row['info'],
            'created' => $row['created']
        ));
    }

    public function save() {
        $query = DB::connection() -> prepare('INSERT INTO forum_user (username, info, created) VALUES (:username, :info, CURRENT_DATE) RETURNING id');
        $query -> execute(array('username' => $this -> username, 'info' => $this -> info));

        $row = $query -> fetch();

        $this -> id = $row['id'];
    }

    // very temporary (needs a lot more protection)
    public function update() {
        $query = DB::connection() -> prepare('UPDATE forum_user SET password = :password, info = :info, edited = CURRENT_DATE RETURNING id');
        $query -> execute(array('password' => $this -> password, 'info' => $this -> info));

        $row = $query -> fetch();

        $this -> id = $row['id'];
    }

    public function destroy() {
        $this -> deleteThreadsOfUser($this -> id);      // this could be done in easier / more efficient way maybe?
        $query = DB::connection() -> prepare('DELETE FROM forum_user WHERE id = :id');
        $query -> execute(array('id' => $this -> id));
    }

    private function deleteThreadsOfUser($userId) {
        $rows = $this -> getThreadsUserPostedIn($userId);
        $this -> deleteThreads($rows, $userId);
    }

    private function getThreadsUserPostedIn($userId) {
        $query = DB::connection() -> prepare('SELECT DISTINCT t.id FROM thread t, post p, forum_user u WHERE t.id = p.thread_id AND p.user_id = :userId');
        $query -> execute(array('userId' => $userId));

        return $query -> fetchAll();
    }

    private function deleteThreads($rows, $userId) {

        foreach ($rows as $row) {
            $threadCreatorId = $this -> getThreadsCreator($row);
            if ($userId == $threadCreatorId) {
                $this -> deleteThread($row['id']);
            }
        }
    }

    private function deleteThread($threadId) {
        $query = DB::connection() -> prepare('DELETE FROM thread WHERE id = :id');
        $query -> execute(array('id' => $threadId));
    }

    private function getThreadsCreator($threadIdRow) {
        $query = DB::connection() -> prepare('SELECT user_id FROM post p WHERE thread_id = :threadId ORDER BY id LIMIT 1');
        $query -> execute(array('threadId' => $threadIdRow['id']));

        $creatorRow = $query -> fetch();
        return $creatorRow['user_id'];
    }
}
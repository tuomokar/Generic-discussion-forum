<?php

class Membership extends BaseModel {

    public $id, $userId, $groupId, $user, $registered, $userAdded;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function membersOfGroup($groupId) {
        $rows = Membership::queryMembershipInfo($groupId);

        $memberships = array();
        foreach ($rows as $row) {
            $memberships[] = new Membership(array(
                'id' => $row['id'],
                'userId' => $row['user_id'],
                'user' => $row['user'],
                'registered' => $row['registered'],
                'userAdded' => $row['added']
            ));
        }

        return $memberships;
    }

    public static function memberCountOfGroup($groupId) {
        $query = DB::connection() -> prepare('SELECT count(*) FROM membership WHERE user_group_id = :id');
        $query -> execute(array('id' => $groupId));

        $rows = $query -> fetch();

        return $rows['count'];
    }

    public static function usersNotInGroup($groupId) {
        $query = DB::connection() -> prepare('SELECT id, username FROM forum_user WHERE id NOT IN (SELECT user_id FROM membership WHERE user_group_id = :id)');
        $query -> execute(array('id' => $groupId));

        $rows = $query -> fetchAll();
        $users = array();

        foreach ($rows as $row) {
            $users[] = new User(array(
                'id' => $row['id'],
                'username' => $row['username']
            ));
        }

        return $users;
    }
    public function save() {
        $query = DB::connection() -> prepare('INSERT INTO membership (user_id, user_group_id, created) VALUES (:user_id, :group_id, CURRENT_DATE)');
        $query -> execute(array('user_id' => $this -> userId, 'group_id' => $this -> groupId));

        UserGroup::updateStatus($this -> groupId);
    }

    public function destroy() {
        $query = DB::connection() -> prepare('DELETE FROM membership WHERE id = :id RETURNING user_group_id');
        $query -> execute(array('id' => $this -> id));

        $row = $query -> fetch();
        $this -> groupId = $row['user_group_id'];

        UserGroup::updateStatus($this -> groupId);
    }

    private static function queryMembershipInfo($groupId) {
        $query = DB::connection() -> prepare('select m.id, u.id AS user_id, u.username AS user, u.created AS registered, m.created AS added FROM forum_user u, membership m WHERE u.id = m.user_id AND m.user_group_id = :id');
        $query -> execute(array('id' => $groupId));

        return $query -> fetchAll();
    }
}
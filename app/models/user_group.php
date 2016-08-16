<?php

class UserGroup extends BaseModel {

    public $id, $name, $info, $created, $edited, $memberCount;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection() -> prepare('SELECT id, name, edited FROM user_group');
        $query -> execute();

        $rows = $query -> fetchAll();

        $userGroups = array();
        foreach ($rows as $row) {
            $id = $row['id'];
            $userGroups[] = new UserGroup(array(
                'id' => $id,
                'name' => $row['name'],
                'edited' => $row['edited'],
                'memberCount' => Membership::memberCountOfGroup($id)
            ));
        }

        return $userGroups;
    }

    // finds the info on the group and its memberships
    public static function find($id) {
        $memberships = Membership::membersOfGroup($id);
        $group = UserGroup::queryGroupInfo($id, $memberships);

        return array(
            'memberships' => $memberships,
            'group' => $group
        );
    }

    // method to updated the edited field of user group externally
    public static function updateStatus($id) {
        $query = DB::connection() -> prepare('UPDATE user_group SET edited = CURRENT_DATE');
        $query -> execute();
    }

    public function save() {
        $query = DB::connection() -> prepare('INSERT INTO user_group (name, info, created) VALUES (:name, :info, CURRENT_DATE ) RETURNING id');
        $query -> execute(array('name' => $this -> name, 'info' => $this -> info));

        $row = $query -> fetch();
        $this -> id = $row['id'];
    }

    public function update() {
        $query = DB::connection() -> prepare('UPDATE user_group SET name = :name, info = :info, edited = CURRENT_DATE WHERE id = :id');
        $query -> execute(array('id' => $this -> id, 'name' => $this -> name, 'info' => $this -> info));
    }

    public function destroy() {
        $query = DB::connection() -> prepare('DELETE FROM user_group WHERE id = :id');
        $query -> execute(array('id' => $this -> id));
    }

    private static function queryGroupInfo($id, $memberships) {
        $query = DB::connection() -> prepare('SELECT id, name, info, created, edited FROM user_group WHERE id = :id LIMIT 1');
        $query -> execute(array('id' => $id));

        $row = $query -> fetch();
        return new UserGroup(array(
            'id' => $row['id'],
            'name' => $row['name'],
            'info' => $row['info'],
            'created' => $row['created'],
            'edited' => $row['edited'],
            'memberCount' => sizeof($memberships)
        ));
    }

}
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
}
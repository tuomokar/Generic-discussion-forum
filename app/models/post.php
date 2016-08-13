<?php

class Post extends BaseModel {

    public $id, $message, $created, $edited, $user_id, $creator;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
}
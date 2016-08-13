<?php

class Thread extends BaseModel {

    public $id, $title, $created, $edited, $creator, $postCount;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
}
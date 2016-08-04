<?php

class PostController extends BaseController{

    public static function postShow() {
        View::make('posts/post_show.html');
    }

    public static function postNew() {
        View::make('posts/post_new.html');
    }

    public static function postEdit() {
        View::make('posts/post_edit.html');
    }

}

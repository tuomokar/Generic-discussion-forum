<?php

class PostController extends BaseController{

    public static function postShow($id) {
        $post = Post::find($id);
        View::make('posts/post_show.html', array('post' => $post));
    }

    public static function postNew() {
        View::make('posts/post_new.html');
    }

    public static function postEdit() {
        View::make('posts/post_edit.html');
    }

}

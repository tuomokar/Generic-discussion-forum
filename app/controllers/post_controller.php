<?php

class PostController extends BaseController {

    public static function postShow($id) {
        $post = Post::find($id);
        View::make('posts/post_show.html', array('post' => $post));
    }

    public static function postNew($threadId) {
        View::make('posts/post_new.html', array('thread_id' => $threadId));
    }

    public static function postEdit($id) {
        $post = Post::fetchIdAndMessage($id);
        View::make('posts/post_edit.html', array('post' => $post));
    }

    public static function postSave($threadId) {
        $params = $_POST;

        $post = new Post(array(
            'message' => $params['message'],
            'user_id' => '3',   // TEMP! Get it from session once that is implemented
            'thread_id' => $threadId
        ));

        $post -> save();

        Redirect::to('/threads/' . $threadId);
    }

    public static function postUpdate($id) {
        $params = $_POST;

        $post = new Post(array(
            'id' => $id,
            'message' => $params['message']
        ));

        $post -> update();

        Redirect::to('/threads/' . $post -> thread_id);
    }

    public static function postDestroy($id) {
        $post = new Post(array(
            'id' => $id
        ));

        $post-> destroy();

        Redirect::to('/threads/' . $post -> thread_id, array('message' => 'Post deleted successfully'));
    }
}
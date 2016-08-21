<?php

class PostController extends BaseController {

    public static function show($id) {
        $post = Post::find($id);
        View::make('posts/post_show.html', array('post' => $post));
    }

    public static function createNew($threadId) {
        self::userLoggedIn();

        View::make('posts/post_new.html', array('threadId' => $threadId));
    }

    public static function edit($id) {
        self::adminOrCreator($id);

        $post = Post::fetchIdAndMessage($id);
        View::make('posts/post_edit.html', array('post' => $post));
    }

    public static function save($threadId) {
        self::userLoggedIn();

        $params = $_POST;

        $post = new Post(array(
            'message' => $params['message'],
            'userId' => SessionController::currentUser() -> id,
            'threadId' => $threadId
        ));

        $errors = $post -> validateWhenSaving();
        if ($errors) {
            View::make('posts/post_new.html', array('errors' => $errors, 'threadId' => $threadId));
        }

        $post -> save();

        Redirect::to('/threads/' . $threadId);
    }

    public static function update($id) {
        self::adminOrCreator($id);

        $params = $_POST;

        $post = new Post(array(
            'id' => $id,
            'message' => $params['message']
        ));

        $errors = $post -> validateWhenUpdating();
        if ($errors) {
            View::make('posts/post_edit.html', array('errors' => $errors));
        }

        $post -> update();

        Redirect::to('/threads/' . $post -> threadId);
    }

    public static function destroy($id) {
        self::userIsAdmin();

        $post = new Post(array(
            'id' => $id
        ));

        $post-> destroy();

        Redirect::to('/threads/' . $post -> threadId, array('message' => 'Post deleted successfully'));
    }
}
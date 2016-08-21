<?php

class BaseController{

    public static function userLoggedIn() {
        if (!SessionController::currentUser()) {
            Redirect::to('/', array('message' => 'You need to login!'));
        }
    }

    public static function userIsAdmin() {
        $user = SessionController::currentUser();
        if (!$user || !$user -> admin) {
            Redirect::to('/', array('message' => "You don't have permission to that!"));
        }
    }

    // checks if user is the owner of the thing recognized by its id, for example the creator of a post
    public static function adminOrCreator($id) {
        $creatorId = Post::findCreatorId($id);

        $user = SessionController::currentUser();
        if (!$user || ($user -> id !== $creatorId && !$user -> admin)) {
            Redirect::to('/', array('message' => "You don't have permission to that!"));
        }

    }
}

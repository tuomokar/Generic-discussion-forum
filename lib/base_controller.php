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
}

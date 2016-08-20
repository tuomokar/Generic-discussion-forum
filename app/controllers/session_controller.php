<?php

class SessionController {

    public static function login() {
        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);

        if ($user) {
            $_SESSION['user'] = $user -> id;
            Redirect::to('/', array('message' => 'Welcome back, ' . $user -> username));
        }
        // render login page if failed
    }

    public static function logout() {
        $message = "Logged out successfully";

        if (!isset($_SESSION['user'])) {
            $message = '';
        } else {
            $_SESSION['user'] = null;
        }

        Redirect::to('/', array('message' => $message));


    }

    public static function currentUser() {
        if (!isset($_SESSION['user'])) {
            return null;
        }
        return User::find($_SESSION['user']);
    }
}
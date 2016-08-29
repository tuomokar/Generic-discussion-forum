<?php

class SessionController extends BaseController {

    public static function login() {
        $params = $_POST;
        $user = User::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('login.html', array('message' => "Gave wrong password or username"));
        }

        $_SESSION['user'] = $user -> id;
        Redirect::to('/', array('message' => 'Welcome back, ' . $user -> username));
    }

    public static function logout() {
        self::userLoggedIn();
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
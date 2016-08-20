<?php

class UserController extends BaseController {

    public static function show($id) {
        $user = User::find($id);
        View::make('users/user_show.html', array('user' => $user));
    }

    public static function createNew() {
        View::make('users/user_new.html');
    }

    public static function edit($id) {
        self::checkPermission();

        $user = User::find($id);
        View::make('users/user_edit.html', array('user' => $user));
    }

    public static function listAll() {
        self::checkPermission();

        $users = User::all();
        View::make('users/user_list.html', array('users' => $users));
    }

    public static function save() {
        $params = $_POST;

        $attributes = array(
            'username' => $params['username'],
            'password' => $params['password'],
            'passwordConfirmation' => $params['password-confirmation'],
            'info' => $params['info']
        );
        $user = new User($attributes);

        $errors = $user -> validateWhenSaving();
        if ($errors) {
            View::make("/users/user_new.html", array('errors' => $errors, 'attributes' => $attributes));
        }

        $user -> save();
        Redirect::to('/users/' . $user -> id, array('message' => "Welcome to Gendifo"));
    }

    public static function update($id) {
        self::checkPermission();

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'password' => $params['old-pw'],
            'newPassword' => $params['new-pw'],
            'info' => $params['info']
        );
        $user = new User($attributes);

        $errors = $user -> validateWhenUpdating();
        if ($errors) {
            $user = User::find($user -> id);
            View::make("/users/user_edit.html", array('errors' => $errors, 'user' => $user));
        }

        $user -> update();
        Redirect::to('/users/' . $user -> id, array('message' => "Updated user info successfully"));
    }

    public static function destroy($id) {
        self::checkPermission();
        $user = new User(array('id' => $id));

        $user -> destroy();
        Redirect::to('/users', array('message' => "Removed user successfully"));
    }

}

<?php

class UserController extends BaseController {

    public static function userShow($id) {
        $user = User::find($id);
        View::make('users/user_show.html', array('user' => $user));
    }

    public static function userNew() {
        View::make('users/user_new.html');
    }

    public static function userEdit($id) {
        $user = User::find($id);
        View::make('users/user_edit.html', array('user' => $user));
    }

    public static function userList() {
        $users = User::all();
        View::make('users/user_list.html', array('users' => $users));
    }

    // needs a lot more protection!
    public static function userSave() {
        $params = $_POST;

        $user = new User(array(
            'username' => $params['username'],
            'password' => $params['password'],
            'info' => $params['info']
        ));

        $user -> save();

        Redirect::to('/users/' . $user -> id, array('message' => "Welcome to Gendifo"));
    }

    // more protection required here too!
    public static function userUpdate($id) {
        $params = $_POST;

        $user = new User(array(
            'id' => $id,
            'password' => $params['new-pw'],
            'info' => $params['info']
        ));

        $user -> update();

        Redirect::to('/users/' . $user -> id, array('message' => "Updated user info successfully"));
    }

    public static function userDestroy($id) {
        $user = new User(array(
            'id' => $id
        ));

        $user -> destroy();

        Redirect::to('/users', array('message' => "Removed user successfully"));
    }

}

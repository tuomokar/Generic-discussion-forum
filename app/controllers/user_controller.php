<?php

class UserController extends BaseController{

    public static function userShow() {
        View::make('users/user_show.html');
    }

    public static function userNew() {
        View::make('users/user_new.html');
    }

    public static function userEdit() {
        View::make('users/user_edit.html');
    }

    public static function userList() {
        View::make('users/user_list.html');
    }

}

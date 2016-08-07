<?php

class UserGroupController extends BaseController{

    public static function userGroupShow() {
        View::make('user-groups/user_group_show.html');
    }

    public static function userGroupNew() {
        View::make('user-groups/user_group_new.html');
    }

    public static function userGroupEdit() {
        View::make('user-groups/user_group_edit.html');
    }

    public static function userGroupList() {
        View::make('user-groups/user_group_list.html');
    }

}

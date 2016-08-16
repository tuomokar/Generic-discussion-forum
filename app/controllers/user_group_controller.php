<?php

class UserGroupController extends BaseController{

    public static function userGroupShow($id) {
        $group = UserGroup::find($id);
        $usersNotInGroup = Membership::usersNotInGroup($id);
        View::make('user-groups/user_group_show.html',
            array('group' => $group, 'usersNotInGroup' => $usersNotInGroup));
    }

    public static function userGroupNew() {
        View::make('user-groups/user_group_new.html');
    }

    public static function userGroupEdit($id) {
        $group = UserGroup::find($id);
        View::make('user-groups/user_group_edit.html', array('group' => $group));
    }

    public static function userGroupList() {
        $groups = UserGroup::all();
        View::make('user-groups/user_group_list.html', array('groups' => $groups));
    }

    public static function userGroupSave() {
        $params = $_POST;

        $group = new UserGroup(array(
            'name' => $params['name'],
            'info' => $params['info']
        ));

        $group -> save();

        Redirect::to('/user-groups/' . $group -> id, array('message' => "Created user group successfully"));
    }

    public static function userGroupUpdate($id) {
        $params = $_POST;

        $group = new UserGroup(array(
            'id' => $id,
            'name' => $params['name'],
            'info' => $params['info']
        ));

        $group -> update();

        Redirect::to('/user-groups/' . $group -> id, array('message' => 'Updated user group info successfully'));
    }

    public static function userGroupDestroy($id) {
        $group = new UserGroup(array('id' => $id));
        $group -> destroy();

        Redirect::to('/user-groups', array('message' => 'Removed user group successfully'));
    }

}
<?php

class UserGroupController extends BaseController{

    public static function show($id) {
        $group = UserGroup::find($id);
        $usersNotInGroup = Membership::usersNotInGroup($id);
        View::make('user-groups/user_group_show.html',
            array('group' => $group, 'usersNotInGroup' => $usersNotInGroup));
    }

    public static function createNew() {
        View::make('user-groups/user_group_new.html');
    }

    public static function edit($id) {
        $group = UserGroup::find($id);
        View::make('user-groups/user_group_edit.html', array('group' => $group));
    }

    public static function listAll() {
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

    public static function update($id) {
        $params = $_POST;

        $group = new UserGroup(array(
            'id' => $id,
            'name' => $params['name'],
            'info' => $params['info']
        ));

        $group -> update();

        Redirect::to('/user-groups/' . $group -> id, array('message' => 'Updated user group info successfully'));
    }

    public static function destroy($id) {
        $group = new UserGroup(array('id' => $id));
        $group -> destroy();

        Redirect::to('/user-groups', array('message' => 'Removed user group successfully'));
    }

}
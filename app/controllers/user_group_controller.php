<?php

class UserGroupController extends BaseController{

    public static function show($id) {
        self::userIsAdmin();

        $group = UserGroup::find($id);
        $usersNotInGroup = Membership::usersNotInGroup($id);
        View::make('user-groups/user_group_show.html',
            array('group' => $group, 'usersNotInGroup' => $usersNotInGroup));
    }

    public static function createNew() {
        self::userIsAdmin();
        View::make('user-groups/user_group_new.html');
    }

    public static function edit($id) {
        self::userIsAdmin();

        $group = UserGroup::find($id);
        View::make('user-groups/user_group_edit.html', array('group' => $group));
    }

    public static function listAll() {
        self::userIsAdmin();

        $groups = UserGroup::all();
        View::make('user-groups/user_group_list.html', array('groups' => $groups));
    }

    public static function userGroupSave() {
        self::userIsAdmin();

        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'info' => $params['info']
        );
        $group = new UserGroup($attributes);

        $errors = $group -> errors();
        if ($errors) {
            View::make('user-groups/user_group_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }

        $group -> save();

        Redirect::to('/user-groups/' . $group -> id, array('message' => "Created user group successfully"));
    }

    public static function update($id) {
        self::userIsAdmin();;

        $params = $_POST;


        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'info' => $params['info']
        );
        $group = new UserGroup($attributes);

        $errors = $group -> errors();
        if ($errors) {
            View::make('user-groups/user_group_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }

        $group -> update();

        Redirect::to('/user-groups/' . $group -> id, array('message' => 'Updated user group info successfully'));
    }

    public static function destroy($id) {
        self::userIsAdmin();

        $group = new UserGroup(array('id' => $id));
        $group -> destroy();

        Redirect::to('/user-groups', array('message' => 'Removed user group successfully'));
    }

}
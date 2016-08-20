<?php

class MembershipController extends BaseController {

    public static function save() {
        self::userIsAdmin();

        $params = $_POST;

        $attributes = array(
            'userId' => $params['userId'],
            'groupId' => $params['groupId']
        );
        $membership = new Membership($attributes);
        $errors = $membership -> errors();

        if ($errors) {
            View::make('user-groups/user_group_show.html', array('membershipErrors' => $errors));
        }

        $membership -> save();

        Redirect::to('/user-groups/' . $membership -> groupId,
            array('Added user to the group successfully'));
    }

    public static function destroy($id) {
        self::userIsAdmin();

        $membership = new Membership(array('id' => $id));

        $membership -> destroy();

        Redirect::to('/user-groups/' . $membership -> groupId,
            array('Removed user from group successfully'));
    }
}
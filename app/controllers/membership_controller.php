<?php

class MembershipController {

    public static function membershipSave() {
        $params = $_POST;

        $membership = new Membership(array(
            'userId' => $params['userId'],
            'groupId' => $params['groupId']
        ));

        $membership -> save();

        Redirect::to('/user-groups/' . $membership -> groupId,
            array('Added user to the group successfully'));
    }

    public static function membershipDestroy($id) {
        $membership = new Membership(array('id' => $id));

        $membership -> destroy();

        Redirect::to('/user-groups/' . $membership -> groupId,
            array('Removed user from group successfully'));
    }
}
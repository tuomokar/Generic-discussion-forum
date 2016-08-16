<?php

class TestController extends BaseController {

    public static function sandbox() {
        $group1 = TopicGroup::find(1);
        $groups = TopicGroup::all();

//        Kint::dump($groups);
//        Kint::dump($group1);

//        $posts = Thread::findPostsOfThread('1');
//        Kint::dump($posts);

//        $groups = UserGroup::all();
//        Kint::dump($groups);
//
//        $memberships = Membership::membersOfGroup(1);
//        Kint::dump($memberships);
//
//        $noMembers = Membership::usersNotInGroup(1);
//        Kint::dump($noMembers);

//        $group = UserGroup::find(1);
//        Kint::dump($group);
    }
}
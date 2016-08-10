<?php

class TestController extends BaseController {

    public static function sandbox() {
        $group1 = TopicGroup::find(1);
        $groups = TopicGroup::all();

        Kint::dump($groups);
        Kint::dump($group1);
    }
}
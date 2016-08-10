<?php

class MainController extends BaseController {

    public static function index() {
        $topicGroups = TopicGroup::all();
        View::make('home.html', array('topicGroups' => $topicGroups));
    }
}

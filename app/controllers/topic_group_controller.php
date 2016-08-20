<?php

class TopicGroupController extends BaseController{

    public static function show($id) {
        $topicGroup = TopicGroup::find($id);
        $threads = TopicGroup::findThreads($id);

        View::make('topic-groups/topic_group_show.html',
            array('topicGroup' => $topicGroup, 'threads' => $threads));
    }

    public static function edit($id) {
        self::checkPermission();

        $topicGroup = TopicGroup::find($id);
        View::make('topic-groups/topic_group_edit.html', array('topicGroup' => $topicGroup));
    }

    public static function createNew() {
        self::checkPermission();

        View::make('topic-groups/topic_group_new.html');
    }

    public static function save() {
        self::checkPermission();

        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'info' => $params['info']
        );
        $topicGroup = new TopicGroup($attributes);

        $errors = $topicGroup -> errors();
        if ($errors) {
            View::make('topic-groups/topic_group_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }

        $topicGroup -> save();

        Redirect::to('/topic-groups/' . $topicGroup -> id, array('message' => 'Created new topic group'));
    }

    public static function update($id) {
        self::checkPermission();

        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'info' => $params['info']
        );

        $topicGroup = new TopicGroup($attributes);

        $errors = $topicGroup -> errors();
        if ($errors) {
            View::make('topic-groups/topic_group_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }

        $topicGroup -> update();

        Redirect::to('/topic-groups/' . $topicGroup -> id, array('message' => 'Edited topic group successfully'));
    }

    public static function destroy($id) {
        self::checkPermission();
        $topicGroup = new TopicGroup(array('id' => $id));

        $topicGroup -> destroy();

        Redirect::to('/', array('message' => 'Removed topic group successfully'));
    }

}
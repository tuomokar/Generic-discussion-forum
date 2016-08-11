<?php

class TopicGroupController extends BaseController{

    public static function topicGroupShow($id) {
        $topicGroup = TopicGroup::find($id);
        View::make('topic-groups/topic_group_show.html', array('topicGroup' => $topicGroup));
    }

    public static function topicGroupEdit($id) {
        $topicGroup = TopicGroup::find($id);
        View::make('topic-groups/topic_group_edit.html', array('topicGroup' => $topicGroup));
    }

    public static function topicGroupNew() {
        View::make('topic-groups/topic_group_new.html');
    }

    // post new
    public static function topicGroupSave() {
        $params = $_POST;

        $topicGroup = new TopicGroup(array(
            'name' => $params['name'],
            'info' => $params['info']
        ));
        $topicGroup -> save();

        Redirect::to('/topic-groups/' . $topicGroup -> id, array('message' => 'Created new topic group'));
    }

    public static function topicGroupUpdate($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'info' => $params['info']
        );

        $topicGroup = new TopicGroup($attributes);
        $topicGroup -> update();

        Redirect::to('/topic-groups/' . $topicGroup -> id, array('message => Edited topic group successfully'));
    }

    public static function topicGroupDestroy($id) {
        $topicGroup = new TopicGroup(array('id' => $id));

        $topicGroup -> destroy();

        Redirect::to('/', array('message' => 'Removed topic group successfully'));
    }

}
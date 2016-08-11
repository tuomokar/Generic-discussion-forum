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

}
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

}
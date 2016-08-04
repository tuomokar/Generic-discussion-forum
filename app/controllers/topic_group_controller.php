<?php

class TopicGroupController extends BaseController{

    public static function topicGroupShow() {
        View::make('topic-groups/topic_group_show.html');
    }

    public static function topicGroupEdit() {
        View::make('topic-groups/topic_group_edit.html');
    }

    public static function topicGroupNew() {
        View::make('topic-groups/topic_group_new.html');
    }

}

<?php

class ThreadController extends BaseController {

    public static function threadNew() {
        $topicGroups = TopicGroup::fetchIdAndName();
        View::make('threads/thread_new.html', array('topicGroups' => $topicGroups));
    }

    public static function threadShow($id) {
        $thread = Thread::find($id);
        $posts = Thread::findPostsOfThread($id);

        View::make('threads/thread_show.html',
            array('thread' => $thread, 'posts' => $posts));
    }

    public static function threadEdit($id) {
        $thread = Thread::find($id);
        View::make('threads/thread_edit.html', array('thread' => $thread));
    }

    // post new
    public static function threadSave() {
        $params = $_POST;

        $thread = new Thread(array(
            'title' => $params['title'],
            'topic_group_id' => $params['topic_group_id']
        ));
        $thread -> save();
        $post = new Post(array(
            'message' => $params['message'],
            'thread_id' => $thread -> id,
            'user_id' => '2'        // Temp! Get it from session when that has been implemented

        ));
        $post -> save();

        Redirect::to('/threads/' . $thread -> id, array('message' => 'Created thread successfully'));
    }

    // post update
    public static function threadUpdate($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'title' => $params['title']
        );

        $thread = new Thread($attributes);
        $thread -> update();

        Redirect::to('/threads/' . $thread -> id, array('message' => 'Edited thread successfully'));
    }

    // post destroy
    public static function threadDestroy($id) {
        $thread = new Thread(array('id' => $id));
        $thread -> destroy();

        Redirect::to('/topic-groups/' . $thread -> topic_group_id, array('message' => 'Removed thread successfully'));
    }
}

<?php

class ThreadController extends BaseController {

    public static function createNew() {
        self::checkPermission();

        $topicGroups = TopicGroup::fetchIdAndName();
        View::make('threads/thread_new.html', array('topicGroups' => $topicGroups));
    }

    public static function show($id) {
        $thread = Thread::find($id);
        $posts = Thread::findPostsOfThread($id);

        View::make('threads/thread_show.html',
            array('thread' => $thread, 'posts' => $posts));
    }

    public static function edit($id) {
        self::checkPermission();

        $thread = Thread::find($id);
        View::make('threads/thread_edit.html', array('thread' => $thread));
    }

    public static function save() {
        self::checkPermission();

        $params = $_POST;

        $threadAttributes = array(
            'title' => $params['title'],
            'topicGroupId' => $params['topicGroupId']
        );
        $postAttributes = array(
            'message' => $params['message'],
            'userId' => SessionController::currentUser() -> id
        );
        $attributes = array_merge($threadAttributes, $postAttributes);

        $thread = new Thread($threadAttributes);
        $post = new Post($postAttributes);

        $threadErrors = $thread -> validateWhenSaving();
        $errors = array_merge($threadErrors, $post -> validateWhenSaving()); // for now doesn't validate group id exists for post

        if ($errors) {
            $topicGroups = TopicGroup::fetchIdAndName();
            View::make('threads/thread_new.html',
                array('errors' => $errors, 'topicGroups' => $topicGroups, 'attributes' => $attributes));
        }

        $thread -> save();
        $post -> threadId = $thread -> id;
        $post -> save();

        Redirect::to('/threads/' . $thread -> id, array('message' => 'Created thread successfully'));
    }

    public static function update($id) {
        self::checkPermission();
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'title' => $params['title'],
            'topicGroupId' => $params['topicGroupId']
        );
        $thread = new Thread($attributes);

        $errors = $thread -> validateWhenUpdating();
        if ($errors) {
            $thread = Thread::find($id);
            View::make('threads/thread_edit.html', array('errors' => $errors, 'thread' => $thread));
        }
        $thread -> update();

        Redirect::to('/threads/' . $thread -> id, array('message' => 'Edited thread successfully'));
    }

    public static function destroy($id) {
        self::checkPermission();
        $thread = new Thread(array('id' => $id));
        $thread -> destroy();

        Redirect::to('/topic-groups/' . $thread -> topipGroupId, array('message' => 'Removed thread successfully'));
    }
}

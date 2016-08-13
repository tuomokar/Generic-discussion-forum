<?php

class ThreadController extends BaseController {

    public static function threadNew() {
        View::make('threads/thread_new.html');
    }

    public static function threadShow($id) {
        $thread = Thread::find($id);
        $posts = Thread::findPostsOfThread($id);

        View::make('threads/thread_show.html',
            array('thread' => $thread, 'posts' => $posts));
    }

    public static function threadEdit($id) {
        View::make('threads/thread_edit.html');
    }

}

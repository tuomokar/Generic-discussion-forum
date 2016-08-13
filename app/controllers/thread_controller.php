<?php

class ThreadController extends BaseController {

    public static function threadNew() {
        View::make('threads/thread_new.html');
    }

    public static function threadShow($id) {
        View::make('threads/thread_show.html');
    }

    public static function threadEdit($id) {
        View::make('threads/thread_edit.html');
    }

}

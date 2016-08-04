<?php

class ThreadController extends BaseController{

    public static function threadShow() {
        View::make('threads/thread_show.html');
    }

    public static function threadNew() {
        View::make('threads/thread_new.html');
    }

    public static function threadEdit() {
        View::make('threads/thread_edit.html');
    }

}

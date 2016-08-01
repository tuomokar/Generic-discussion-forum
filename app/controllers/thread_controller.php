<?php

class ThreadController extends BaseController{

    public static function threadShow() {
        View::make('threads/thread_show.html');
    }

}

<?php

class MainController extends BaseController {

    public static function index() {
        View::make('home.html');
    }
}

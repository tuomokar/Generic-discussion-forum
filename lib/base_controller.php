<?php

class BaseController{

    public static function checkPermission() {
        if (!SessionController::currentUser()) {
            Redirect::to('/', array('message' => 'You need to login!'));
        }
    }
}

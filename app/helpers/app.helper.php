<?php

require_once './app/views/error.view.php';

class AppHelper {

    public static function notFound($error) {
        $view = new ErrorView();
        $view->notFound($error);
    }
}
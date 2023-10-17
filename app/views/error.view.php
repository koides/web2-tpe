<?php

require_once './app/views/view.php';

class ErrorView extends View{
    
    public function notFound($errorString) {
        require './app/templates/error.notfound.phtml';
        die();
    }
}
<?php

require_once './app/views/view.php';

class Controller {

    protected $view;

    public function __construct() {
        $this->view = new View();
    }

    public function showError($errorString = null) {
        $errorString = ( !isset($errorString) ) ? '404 - pagina no encontrada' : $errorString;
        $this->view->showError($errorString);
    }
}
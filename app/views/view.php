<?php

class View {
    protected $session;

    public function __construct() {
        $this->session = AuthHelper::check();
    }

    public function showError($errorString) {
        require './app/templates/error.phtml';
        die();
    }
}
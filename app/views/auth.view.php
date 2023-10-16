<?php

class AuthView {
    private $session;

    public function __construct() {
        $this->session = AuthHelper::check();
    }

    public function showLogin($error = null) {
        require './app/templates/login.phtml';
    }
}
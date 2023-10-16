<?php

class AuthView {
    public function showLogin($error = null) {
        require './app/templates/login.phtml';
    }
}
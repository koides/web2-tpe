<?php

class View {
    protected $session;

    public function __construct() {
        $this->session = AuthHelper::check();
    }
}
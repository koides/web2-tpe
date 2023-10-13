<?php

class MusicView {
    public $form = './app/templates/form.add.phtml';

    public function showMusic($music) {
        // mostrar el template
        require './app/templates/music.list.phtml';
    }

    public function editMode() {
        $this->form = './app/templates/form.edit.phtml';
    }

    public function normalMode() {
        $this->form = './app/templates/form.add.phtml';
    }
    /*public function showError($error) {
        require 'templates/error.phtml';
    }*/
}

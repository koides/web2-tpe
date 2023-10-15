<?php

class MusicView {
    public $form = './app/templates/form.add.phtml';

    public function showMusic($music) {
        // mostrar el template
        require './app/templates/music.list.phtml';
    }

    public function loadForm($album, $music) { 
        $this->form = './app/templates/form.edit.phtml';
        require './app/templates/music.list.phtml';
    }
    /*public function showError($error) {
        require 'templates/error.phtml';
    }*/
}

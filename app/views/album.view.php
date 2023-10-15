<?php

class AlbumView {
    public $form = './app/templates/form.add.album.phtml';

    public function showMusic($music) {
        // mostrar el template
        require './app/templates/list.album.phtml';
    }

    public function loadForm($album, $music) { 
        $this->form = './app/templates/form.edit.album.phtml';
        require './app/templates/list.album.phtml';
    }
    /*public function showError($error) {
        require 'templates/error.phtml';
    }*/
}

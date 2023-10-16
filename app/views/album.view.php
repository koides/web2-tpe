<?php

class AlbumView {
    private $form = './app/templates/form.add.album.phtml';

    public function showAlbums($albums) {
        // mostrar el template
        require './app/templates/list.albums.phtml';
    }

    public function showAlbum($album, $songs) {
        $duracion = 0;
        foreach ($songs as $song) {
            $duracion += $song->duracion;
        }
        require './app/templates/detail.album.phtml';
    }

    public function editForm($album, $albums) { 
        $this->form = './app/templates/form.edit.album.phtml';
        require './app/templates/list.albums.phtml';
    }
    /*public function showError($error) {
        require 'templates/error.phtml';
    }*/
}

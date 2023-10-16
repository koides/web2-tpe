<?php

class AlbumView {
    private $form = './app/templates/form.add.album.phtml';

    public function showAlbums($albums) {
        require './app/templates/list.albums.phtml';
    }

    public function showAlbum($album, $songs) {
        //sumamos la duracion de cada cancion para calcular la del album
        $duracion = 0;
        foreach ($songs as $song) {
            $duracion += $song->duracion;
            $song->duracion = gmdate("i:s", $song->duracion);
        }
        //convertimos la duracion de segundos a mm:ss
        $duracion = gmdate("i:s", $duracion);
        $tracks= count($songs);
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

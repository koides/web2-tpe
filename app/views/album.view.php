<?php

class AlbumView {
    private $session;
    private $form;

    public function __construct() {
        //guardamos el estado de la sesion para saber que mostrar y que no
        $this->session = AuthHelper::check();
        $this->form = './app/templates/form.add.album.phtml';  
    }

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

    public function removeConfirmation($count, $id, $albums) {
        $this->form = './app/templates/form.remove.album.phtml';
        require './app/templates/list.albums.phtml';
    }

    /*public function showError($error) {
        require 'templates/error.phtml';
    }*/
}

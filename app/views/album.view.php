<?php

require_once './app/views/view.php';

class AlbumView extends View{

    public function showAlbums($albums) {
        //seteamos el form para AGREGAR albumes
        $form = './app/templates/form.add.album.phtml';  
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
        $duracion = ( $duracion > 3600 ) ? gmdate("h:i:s", $duracion) : gmdate("i:s", $duracion);
        $tracks= count($songs);
        require './app/templates/detail.album.phtml';
    }

    public function editForm($album, $albums) {
        //seteamos el form para EDITAR albumes
        $form = './app/templates/form.edit.album.phtml';
        require './app/templates/list.albums.phtml';
    }

    public function removeConfirmation($count, $id, $albums) {
        //seteamos el form para BORRAR album y sus dependencias
        $form = './app/templates/form.remove.album.phtml';
        require './app/templates/list.albums.phtml';
    }

    /*public function showError($error) {
        require 'templates/error.phtml';
    }*/
}

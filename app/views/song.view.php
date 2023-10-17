<?php

require_once './app/views/view.php';

class SongView extends View {

    public function showSongs($songs, $albums) {
        
        //pasamos la duracion de segundos a mm:ss
        foreach ($songs as $song) {
            $song->duracion = gmdate("i:s", $song->duracion);
        }

        //seteamos el form para agregar canciones
        $form = './app/templates/form.add.song.phtml';
        require './app/templates/list.songs.phtml';
    }

    public function showSong($song, $album) {
        $song->duracion = gmdate("i:s", $song->duracion);
        require './app/templates/detail.song.phtml';
    }

    public function editForm($song, $songs, $albums) {
        //seteamos el form para editar canciones
        $form = './app/templates/form.edit.song.phtml';
        require './app/templates/list.songs.phtml';
    }
}
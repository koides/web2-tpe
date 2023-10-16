<?php

class SongView {
    private $form = './app/templates/form.add.song.phtml';

    public function showSongs($songs, $albums) {
        foreach ($songs as $song) {
            $song->duracion = gmdate("i:s", $song->duracion);
        }
        require './app/templates/list.songs.phtml';
    }

    public function showSong($song, $album) {
        $song->duracion = gmdate("i:s", $song->duracion);
        require './app/templates/detail.song.phtml';
    }

    public function editForm($song, $songs, $albums) {
        $this->form = './app/templates/form.edit.song.phtml';
        require './app/templates/list.songs.phtml';
    }
}
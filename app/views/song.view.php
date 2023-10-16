<?php

class SongView {
    private $form = './app/templates/form.add.song.phtml';

    public function showSongs($songs, $albums) {
        require './app/templates/list.songs.phtml';
    }

    public function editForm($song, $songs, $albums) {
        $this->form = './app/templates/form.edit.song.phtml';
        require './app/templates/list.songs.phtml';
    }
}
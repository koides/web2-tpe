<?php

class SongView {

private $form = './app/templates/form.add.song.phtml';

    public function showSongs($songs, $albums) {
        require './app/templates/list.song.phtml';
    }
}
<?php

<<<<<<< HEAD:app/views/musicView.php
class MusicView {
    public function showMusic($music) {
=======
class MusicView
{
    public function showMusic($music)
    {
        $count = count($music);

>>>>>>> 456cdefb118f2945a178a90bc5a5666bcad8662e:app/views/music.view.php
        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion

        // mostrar el template
        require './app/templates/musicList.phtml';
    }

    /*public function showError($error) {
        require 'templates/error.phtml';
    }*/
}

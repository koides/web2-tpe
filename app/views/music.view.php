<?php

class MusicView
{
    public function showMusic($music)
    {
        $count = count($music);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion

        // mostrar el template
        require './app/templates/musicList.phtml';
    }

    /*public function showError($error) {
        require 'templates/error.phtml';
    }*/
}

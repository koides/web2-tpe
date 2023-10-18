<?php

class MusicView {
    public $form = './app/templates/form.add.phtml';
    public function showMusic($music) {
        $count = count($music);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion

        // mostrar el template
        require './app/templates/music.list.phtml';
    }

    public function loadForm($album, $music) { 
        $this->form = './app/templates/form.edit.phtml';
        require './app/templates/music.list.phtml';
    }
}

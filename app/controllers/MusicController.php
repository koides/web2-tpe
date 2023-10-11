<?php
require_once './app/views/musicView.php';
require_once './app/models/music.model.php';

class MusicController {
    private $model;
    private $view;

    public function __contruct() {
        $this->model = new MusicModel();
        $this->view = new MusicView();
    }

    public function listMusic() {
        //le pedimos la lista de musica al modelo
        $numero = 0;
        echo var_dump($this->model);
        echo "cosa";
        //$music = $this->model->getMusic();

        //mandamos la lista a la vista para que la muestre
        //$this->view->showMusic($music);
    }
} 
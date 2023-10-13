<?php
require_once './app/views/music.view.php';
require_once './app/models/music.model.php';
class MusicController

{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new MusicModel();
        $this->view = new MusicView();
    }

    public function listMusic()
    {
        //le pedimos la lista de musica al modelo
        $music = $this->model->getMusic();

        //mandamos la lista a la vista para que la muestre
        $this->view->showMusic($music);
    }
}

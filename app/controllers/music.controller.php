<?php
require_once './app/views/music.view.php';
require_once './app/models/music.model.php';

class MusicController
{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new MusicModel();
        $this->view = new MusicView();
    }

    public function listMusic() {
        //le pedimos la lista de musica al modelo
        $music = $this->model->getMusic();

        //mandamos la lista a la vista para que la muestre
        $this->view->showMusic($music);
    }

    public function addMusic() {
        //consigo los datos del usuario
        $cancion = $_POST['cancion'];
        $album = $_POST['album'];
        $duracion = $_POST['duracion'];
        $track = $_POST['track'];

        //validaciones
        if (empty($cancion) || empty($album) || empty($duracion) || empty($track)) {
            //$this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertMusic($cancion, $album, $duracion, $track);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            header('Location: ' . BASE_URL);
            echo "cuak";
            //$this->view->showError("Error al insertar la tarea");
        }
    } 
}
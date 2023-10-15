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
        //consigo los datos del formulario
        $album= $_POST['album'];
        $artista= $_POST['artista'];
        $anio= $_POST['anio'];
        $discografica= $_POST['discografica'];

        //validaciones
        if (empty($album) || empty($artista) || empty($anio) || empty($discografica)) {
            //$this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertMusic($album, $artista, $anio, $discografica);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            echo "cuak";
            //$this->view->showError("Error al insertar la tarea");
        }
    }

    public function removeMusic($id) {
        $this->model->deleteMusic($id);
        header('Location: ' . BASE_URL);                
    }

    public function editMusic($id) {
        //conseguimos los datos del item a editar
        $album = $this->model->getAlbum($id);
        $music = $this->model->getMusic();

        $this->view->loadForm($album, $music);

        //header('Location: ' . BASE_URL);
    }

    public function cancelEdit() {
        header('Location: ' . BASE_URL);
    }

    public function saveEdit($id) {
        $album= $_POST['album'];
        $artista= $_POST['artista'];
        $anio= $_POST['anio'];
        $discografica= $_POST['discografica'];

        //validaciones
        if (empty($album) || empty($artista) || empty($anio) || empty($discografica)) {
            //$this->view->showError("Debe completar todos los campos");
            return;
        }

        $this->model->saveAlbum($id, $album, $artista, $anio, $discografica);
        header('Location: ' . BASE_URL);
    }
}
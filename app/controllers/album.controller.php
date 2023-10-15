<?php
require_once './app/views/album.view.php';
require_once './app/models/music.model.php';

class AlbumController
{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new MusicModel();
        $this->view = new AlbumView();
    }

    public function list() {
        //le pedimos la lista de musica al modelo
        $music = $this->model->getAlbums();

        //mandamos la lista a la vista para que la muestre
        $this->view->showMusic($music);
    }

    public function save($id = null) {
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

        if (isset($id)) {
            //si se paso id, quiere decir que estoy modificando un item
            $this->model->saveAlbum($album, $artista, $anio, $discografica, $id);
            header('Location: ' . BASE_URL);
        } else {
            //de no pasarse un id, se agrega un nuevo item
            $set = $this->model->saveAlbum($album, $artista, $anio, $discografica);
            if ($set) {
                header('Location: ' . BASE_URL);
            } else {
                echo "cuak";
                //$this->view->showError("Error al insertar la tarea");
            }
        }
    }

    public function remove($id) {
        $this->model->deleteAlbum($id);
        header('Location: ' . BASE_URL);                
    }

    public function edit($id) {
        //conseguimos los datos del item a editar
        $album = $this->model->getAlbum($id);
        $music = $this->model->getAlbums();

        $this->view->loadForm($album, $music);

        //header('Location: ' . BASE_URL);
    }

    public function cancel() {
        header('Location: ' . BASE_URL . 'albums');
    }
}
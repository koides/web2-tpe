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

    public function list($id = null) {
        if ( isset($id) ) {
            //si id tiene un valor, pedimos al modelo el album correspondiente
            $album = $this->model->getAlbum($id);
            $songs = $this->model->getAlbumSongs($id);
            
            //se lo pasamos al view
            $this->view->showAlbum($album, $songs);
        } else {
            //le pedimos la lista de musica al modelo
            $albums= $this->model->getAlbums();

            //mandamos la lista a la vista para que la muestre
            $this->view->showAlbums($albums);
        }
    }

    public function save($id = null) {
        //consigo los datos del formulario
        $album= $_POST['album'];
        $artista= $_POST['artista'];
        $anio= $_POST['anio'];
        $discografica= $_POST['discografica'];

        //validaciones
        if ( empty($album) || empty($artista) || empty($anio) || empty($discografica) ) {
            //$this->view->showError("Debe completar todos los campos");
            return;
        }

        if ( isset($id) ) {
            //si se paso id, quiere decir que estoy modificando un item
            $this->model->saveAlbum($album, $artista, $anio, $discografica, $id);
            header('Location: ' . BASE_URL . 'albums/list');
        } else {
            //de no pasarse un id, se agrega un nuevo item
            $set = $this->model->saveAlbum($album, $artista, $anio, $discografica);
            if ($set) {
                header('Location: ' . BASE_URL . 'albums/list');
            } else {
                echo "cuak";
                //$this->view->showError("Error al insertar la tarea");
            }
        }
    }

    public function remove($id) {
        $count = $this->model->checkAlbum($id);
        if ( $count > 0 ) {
            $albums = $this->model->getAlbums();
            $this->view->removeConfirmation($count, $id, $albums);
        } else {
            header('Location: ' . BASE_URL . 'albums/list');                
        }
    }

    public function rmvall($id) {
        //conseguimos los items a borrar
        $songs = $this->model->getAlbumSongs($id);
        $album = $this->model->getAlbum($id);
        //borramos todas las canciones primero
        foreach ($songs as $song) { $this->model->deleteSong($song->cancion_id); }
        //finalmente el album
        $this->model->deleteAlbum($id);

        header('Location: ' . BASE_URL . 'albums/list');                
    }

    public function edit($id) {
        //conseguimos los datos del item a editar
        $album = $this->model->getAlbum($id);
        $albums= $this->model->getAlbums();

        $this->view->editForm($album, $albums);
    }
}
<?php
require_once './app/views/song.view.php';
require_once './app/models/music.model.php';

class SongController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new MusicModel();
        $this->view = new SongView();
    }

    public function list($id = null) {
        if ( isset($id) ) {
            //si id != null, pedimos al modelo los datos de la cancion y el album correspondiente, y se lo pasamos al view
            $song = $this->model->getSong($id);
            $album = $this->model->getAlbum($song->album);

            $this->view->showSong($song, $album);
        } else {        
            //le pedimos la lista de canciones y la lista de albumes al modelo (para el select del form) y lo pasamos al view
            $songs = $this->model->getSongs();
            $albums = $this->model->getAlbums();

            $this->view->showSongs($songs, $albums);
        }
    }

    public function save($id = null) {
        //checkeamos que estemos logueado
        AuthHelper::verify();

        //consigo los datos del formulario
        $cancion= $_POST['cancion'];
        $album= $_POST['album'];
        $duracion= $_POST['duracion'];
        $track= $_POST['track'];

        //validaciones
        if (empty($cancion) || empty($album) || empty($duracion) || empty($track)) {
            //$this->view->showError("Debe completar todos los campos");
            return;
        }

        if (isset($id)) {
            //si se paso id, quiere decir que estoy modificando un item
            $this->model->saveSong($cancion, $album, $duracion, $track, $id);
            header('Location: ' . BASE_URL . 'songs/list');
        } else {
            //de no pasarse un id, se agrega un nuevo item
            $set = $this->model->saveSong($cancion, $album, $duracion, $track, $id);
            if ($set) {
                header('Location: ' . BASE_URL . 'songs/list');
            } else {
                echo "cuak";
                //$this->view->showError("Error al insertar la tarea");
            }
        }
    }

    public function remove($id) {
        //checkeamos que estemos logueado
        AuthHelper::verify();
        
        $this->model->deleteSong($id);
        header('Location:  ' . BASE_URL . 'songs/list');                
    }

    public function edit($id) {
        //checkeamos que estemos logueado
        AuthHelper::verify();

        $song = $this->model->getSong($id);
        $songs = $this->model->getSongs();
        $albums = $this->model->getAlbums();
    
        $this->view->editForm($song, $songs, $albums);
    }
}
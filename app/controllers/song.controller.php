<?php

require_once './app/controllers/controller.php';
require_once './app/views/song.view.php';
require_once './app/models/music.model.php';

class SongController extends Controller{
    private $model;

    public function __construct() {
        $this->view = new SongView();
        $this->model = new MusicModel();
    }

    public function list($id = null) {
        if ( isset($id) ) {
            //si id != null, pedimos al modelo los datos de la cancion
            $song = $this->model->getSong($id);
            //checkeamos si existe en la db
            if ($song) {
                //pedimos el album correspondiente usando el FK de la cancion, q corresponde al id del album
                $album = $this->model->getAlbum($song->album);
                //pasamos al view
                $this->view->showSong($song, $album);
            } else {
                //la cancion no existe en la db
                $this->view->showError('La canción solicitada no existe en nuestra base de datos');
            }
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

        if ( isset($id) ) {
            //si se paso id, quiere decir que estoy modificando un item
            $this->model->saveSong($cancion, $album, $duracion, $track, $id);
            header('Location: ' . BASE_URL . 'songs');
        } else {
            //de no pasarse un id, se agrega un nuevo item
            $set = $this->model->saveSong($cancion, $album, $duracion, $track, $id);
            if ($set) {
                header('Location: ' . BASE_URL . 'songs');
            } else {
                $this->view->showError("Error al insertar la canción");
            }
        }
    }

    public function remove($id) {
        //checkeamos que estemos logueado
        AuthHelper::verify();
        
        $this->model->deleteSong($id);
        header('Location:  ' . BASE_URL . 'songs');                
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
<?php

require_once './app/controllers/controller.php';
require_once './app/views/album.view.php';
require_once './app/models/album.model.php';
require_once './app/models/song.model.php';

class AlbumController extends Controller {
    private $albumModel;
    private $songModel;

    public function __construct() {
        $this->view = new AlbumView();
        $this->albumModel = new AlbumModel();
        $this->songModel = new SongModel();
    }

    public function list($id = null) {
        if ( isset($id) ) {
            //si id tiene un valor, pedimos al modelo el album correspondiente
            $album = $this->albumModel->getAlbum($id);
            if ($album) {
                //pedimos las canciones correspondientes al album
                $songs = $this->songModel->getAlbumSongs($id);
                //le pasamos todo al view
                $this->view->showAlbum($album, $songs);
            } else {
                //el album no existe en la db
                $this->view->showError('El album solicitado no existe en nuestra base de datos');
            }
        } else {
            //le pedimos la lista de musica al modelo
            $albums = $this->albumModel->getAlbums();

            //mandamos la lista a la vista para que la muestre
            $this->view->showAlbums($albums);
        }
    }

    public function save($id = null) {
        //checkeamos que estemos logueado
        AuthHelper::verify();

        //consigo los datos del formulario
        $album= $_POST['album'];
        $artista= $_POST['artista'];
        $anio= $_POST['anio'];
        $discografica= $_POST['discografica'];

        //validaciones
        if ( empty($album) || empty($artista) || empty($anio) || empty($discografica) ) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        if ( isset($id) ) {
            //si se paso id, quiere decir que estoy modificando un item
            $this->albumModel->saveAlbum($album, $artista, $anio, $discografica, $id);
            header('Location: ' . BASE_URL . 'albums');
        } else {
            //de no pasarse un id, se agrega un nuevo item
            $set = $this->albumModel->saveAlbum($album, $artista, $anio, $discografica);
            if ($set) {
                header('Location: ' . BASE_URL . 'albums');
            } else {
                $this->view->showError("Error al insertar el album");
            }
        }
    }

    public function remove($id) {
        //checkeamos que estemos logueado
        AuthHelper::verify();

        $count = $this->albumModel->checkAlbum($id);
        if ( $count > 0 ) {
            $albums = $this->albumModel->getAlbums();
            $this->view->removeConfirmation($count, $id, $albums);
        } else {
            header('Location: ' . BASE_URL . 'albums');                
        }
    }

    public function rmvall($id) {
        //checkeamos que estemos logueado
        AuthHelper::verify();

        //conseguimos los items a borrar
        $songs = $this->songModel->getAlbumSongs($id);
        $album = $this->albumModel->getAlbum($id);
        //borramos todas las canciones primero
        foreach ($songs as $song) { $this->songModel->deleteSong($song->cancion_id); }
        //finalmente el album
        $this->albumModel->deleteAlbum($id);

        header('Location: ' . BASE_URL . 'albums');                
    }

    public function edit($id) {
        //checkeamos que estemos logueado
        AuthHelper::verify();

        //conseguimos los datos del item a editar
        $album = $this->albumModel->getAlbum($id);
        $albums= $this->albumModel->getAlbums();

        $this->view->editForm($album, $albums);
    }
}
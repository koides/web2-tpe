<?php
class MusicModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost; dbname=musica; charset=utf8', 'root', '');
    }

<<<<<<< HEAD
    public function get_all(){
=======
    public function getMusic() {
>>>>>>> 456cdefb118f2945a178a90bc5a5666bcad8662e
        $query = $this->db->prepare('SELECT * FROM canciones');
        $query->execute();

        $music = $query->fetchAll(PDO::FETCH_OBJ);

        return $music;
    }
    
    public function insertMusic($cancion, $album, $duracion, $track) {
        $query = $this->db->prepare('INSERT INTO canciones(cancion_nombre, album, duracion, track) VALUES(?,?,?,?)');
        $query->execute([$cancion, $album, $duracion, $track]);

        return $this->db->lastInsertId();
    }
}

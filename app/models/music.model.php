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
<<<<<<< HEAD
>>>>>>> 456cdefb118f2945a178a90bc5a5666bcad8662e
        $query = $this->db->prepare('SELECT * FROM canciones');
=======
        $query = $this->db->prepare('SELECT * FROM albumes');
>>>>>>> f0776f196a3d860a84d1628745aae09948750a8a
        $query->execute();

        $music = $query->fetchAll(PDO::FETCH_OBJ);

        return $music;
    }

    public function getAlbum($id) {
        $query = $this->db->prepare('SELECT * FROM albumes WHERE album_id=?');
        $query->execute([$id]);

        $album = $query->fetch(PDO::FETCH_OBJ);

        return $album;
    }
    
    public function insertMusic($album, $artista, $anio, $discografica) {
        $query = $this->db->prepare('INSERT INTO albumes (album_nombre, artista, anio, discografica) VALUES(?,?,?,?)');
        $query->execute([$album, $artista, $anio, $discografica]);

        return $this->db->lastInsertId();
    }

    public function deleteMusic($id) {
        $query = $this->db->prepare('DELETE FROM albumes WHERE album_id =?');
        $query->execute([$id]);
    }

    public function saveAlbum($id, $album, $artista, $anio, $discografica) {
        $query = $this->db->prepare('UPDATE albumes SET album_nombre=?, artista=?, anio=?, discografica=? WHERE album_id=?');
        $query->execute([$album, $artista, $anio, $dicografica, $id]);
    }
}

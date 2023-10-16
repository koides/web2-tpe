<?php

class MusicModel{
    private $db;
    
    public function __construct() {
        $this->db = new PDO(DB_CONNECT_STRING, DB_USER, DB_PASS);
    }
    
    public function getAlbums() {
        $query = $this->db->prepare('SELECT * FROM albumes ORDER BY album_nombre');
        $query->execute();
        
        $albums = $query->fetchAll(PDO::FETCH_OBJ);
        return $albums;
    }
    
    public function getSongs() {
        $query = $this->db->prepare('SELECT canciones.*, albumes.album_nombre FROM canciones INNER JOIN albumes ON canciones.album = albumes.album_id ORDER BY cancion_nombre');
        
        $query->execute();
        
        $songs = $query->fetchAll(PDO::FETCH_OBJ);
        return $songs;
    }
    
    public function getAlbum($id) {
        $query = $this->db->prepare('SELECT * FROM albumes WHERE album_id=?');
        $query->execute([$id]);
        
        $album = $query->fetch(PDO::FETCH_OBJ);
        return $album;
    }

    public function getAlbumSongs($id) {
        $query = $this->db->prepare('SELECT * FROM canciones WHERE album=? ORDER BY track');
        $query->execute([$id]);

        $songs = $query->fetchAll(PDO::FETCH_OBJ);
        return $songs;
    }
    
    public function getSong($id) {
        $query = $this->db->prepare('SELECT * FROM canciones WHERE cancion_id=?');
        $query->execute([$id]);
    
        $song = $query->fetch(PDO::FETCH_OBJ);
        return $song;
    }
    
    public function saveAlbum($album, $artista, $anio, $discografica, $id = null) {
        if (isset($id)) {
            $query = $this->db->prepare('UPDATE albumes SET album_nombre=?, artista=?, anio=?, discografica=? WHERE album_id=?');
            $query->execute([$album, $artista, $anio, $discografica, $id]);
        } else {
            $query = $this->db->prepare('INSERT INTO albumes (album_nombre, artista, anio, discografica) VALUES(?, ?, ?, ?)');
            $query->execute([$album, $artista, $anio, $discografica]);

            return $this->db->lastInsertId();
        }
    }

    public function saveSong($cancion, $album, $duracion, $track, $id = null) {
        if (isset($id)) {
            $query = $this->db->prepare('UPDATE canciones SET cancion_nombre=?, album=?, duracion=?, track=? WHERE cancion_id=?');
            $query->execute([$cancion, $album, $duracion, $track, $id]);
        } else {
            $query = $this->db->prepare('INSERT INTO canciones (cancion_nombre, album, duracion, track) VALUES(?, ?, ?, ?)');
            $query->execute([$cancion, $album, $duracion, $track]);

            return $this->db->lastInsertId();
        }
    }

    public function checkAlbum($id) {
        //hacemos un query contando si el album tiene canciones asignadas
        $query = $this->db->prepare('SELECT COUNT(cancion_id) FROM canciones WHERE album=?');
        $query->execute([$id]);
        $songCount = $query->fetch(PDO::FETCH_NUM);

        if ($songCount[0] == 0 ) {
            //en caso de no tenerlas, lo borramos sin mas
            $query = $this->db->prepare('delete from albumes where album_id=?');
            $query->execute([$id]);
        }

        //devolvemos la cantidad de canciones, para darle la eleccion al usuario
        return $songCount[0];
    }

    public function deleteAlbum($id) {
        $query = $this->db->prepare('delete from albumes where album_id=?');
        $query->execute([$id]);
    }

    public function deleteSong($id) {
        $query = $this->db->prepare('DELETE FROM canciones WHERE cancion_id=?');
        $query->execute([$id]);
    }
}

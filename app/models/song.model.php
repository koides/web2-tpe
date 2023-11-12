<?php

require_once './app/models/model.php';

class SongModel extends Model {

    public function getSongs() {
        $query = $this->db->prepare('SELECT canciones.*, albumes.album_nombre FROM canciones INNER JOIN albumes ON canciones.album = albumes.album_id ORDER BY cancion_nombre');
        
        $query->execute();
        $songs = $query->fetchAll(PDO::FETCH_OBJ);
        return $songs;
    }

    public function getSong($id) {
        $query = $this->db->prepare('SELECT * FROM canciones WHERE cancion_id=?');
        $query->execute([$id]);
    
        $song = $query->fetch(PDO::FETCH_OBJ);
        return $song;
    }

    public function getAlbumSongs($album_id) {
        $query = $this->db->prepare('SELECT * FROM canciones WHERE album=? ORDER BY track');
        $query->execute([$album_id]);

        $songs = $query->fetchAll(PDO::FETCH_OBJ);
        return $songs;
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

    public function deleteSong($id) {
        $query = $this->db->prepare('DELETE FROM canciones WHERE cancion_id=?');
        $query->execute([$id]);
    }
}
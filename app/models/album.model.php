<?php

require_once './app/models/model.php';

class AlbumModel extends Model {
    
    public function getAlbums() {
        $query = $this->db->prepare('SELECT * FROM albumes ORDER BY album_nombre');
        $query->execute();
        
        $albums = $query->fetchAll(PDO::FETCH_OBJ);
        return $albums;
    }
    
    public function getAlbum($id) {
        $query = $this->db->prepare('SELECT * FROM albumes WHERE album_id=?');
        $query->execute([$id]);
        
        $album = $query->fetch(PDO::FETCH_OBJ);
        return $album;
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

    public function checkAlbum($id) {
        //hacemos un query contando si el album tiene canciones asignadas
        $query = $this->db->prepare('SELECT cancion_id FROM canciones WHERE album=?');
        $query->execute([$id]);
        $songs= $query->fetchAll(PDO::FETCH_NUM);
        $count = count($songs);

        if ( $count == 0 ) {
            //en caso de no tenerlas, lo borramos sin mas
            $query = $this->db->prepare('DELETE FROM albumes where album_id=?');
            $query->execute([$id]);
        }

        //devolvemos la cantidad de canciones, para darle la eleccion al usuario
        return $count; 
    }

    public function deleteAlbum($id) {
        $query = $this->db->prepare('DELETE FROM albumes where album_id=?');
        $query->execute([$id]);
    }
}

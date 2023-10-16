<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO(DB_CONNECT_STRING, DB_USER, DB_PASS);
    }

    public function getByUser($user) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE user=?');
        $query->execute([$user]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}
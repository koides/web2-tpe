<?php
require_once './app/helpers/db.helper.php';

class Model {
    protected $db;
    
    public function __construct() {
        //si la db no existe, la creamos
        DbHelper::tryCreateDB();
        //ya creada la asignamos
        $this->db = new PDO(DB_CONNECT_STRING, DB_USER, DB_PASS);
        //hacemos el deploy
        DbHelper::deploy($this->db);
    }
}
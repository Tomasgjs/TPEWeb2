<?php

class CancionesModel{
    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=db_cancionero;charset=utf8', 'root', '');
    }

    function getCanciones(){
        $query = $this->db->prepare('SELECT * FROM canciones');
        $query->execute();

        $canciones = $query->fetchAll(PDO::FETCH_OBJ);
        return $canciones;
    }
}
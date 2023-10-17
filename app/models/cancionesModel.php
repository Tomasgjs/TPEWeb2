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

    public function getCancionById($id) {
        $query = $this->db->prepare('SELECT * FROM canciones WHERE id = ?');
        $query->execute([$id]);

        $cancion = $query->fetch(PDO::FETCH_OBJ);
        return $cancion;
    }

    function addCancion($nombre, $duracion, $album) {
        $query = $this->db->prepare('INSERT INTO canciones (nombre, duracion, album) VALUES(?,?,?)');
        $query->execute([$nombre, $duracion, $album]);

        return $this->db->lastInsertId();
    }

    function removeCancion($id) {
        $query = $this->db->prepare('DELETE FROM canciones WHERE id = ?');
        $query->execute([$id]);
    }

    function editCancion($id, $nombre, $duracion, $album) {
        $query = $this->db->prepare('UPDATE canciones SET nombre = ?, duracion = ?, album = ? WHERE id = ?');
        $query->execute([$nombre, $duracion, $album, $id]);
    }
}
<?php

class AlbumModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_cancionero;charset=utf8', 'root', '');
    }


    function getAlbums() {
        $query = $this->db->prepare('SELECT * FROM albumes');
        $query->execute();

        // $tasks es un arreglo de tareas
        $albums = $query->fetchAll(PDO::FETCH_OBJ);

        return $albums;
    }

    public function getAlbumById($id) {
        $query = $this->db->prepare('SELECT * FROM albumes WHERE id = ?');
        $query->execute([$id]);

        $album = $query->fetch(PDO::FETCH_OBJ);
        return $album;
    }

    function insertAlbum($nombre, $autor, $fecha) {
        $query = $this->db->prepare('INSERT INTO albumes (nombre, autor, fecha) VALUES(?,?,?)');
        $query->execute([$nombre, $autor, $fecha]);

        return $this->db->lastInsertId();
    }

    function removeAlbum($id) {
        $query = $this->db->prepare('DELETE FROM albumes WHERE id = ?');
        $query->execute([$id]);
    }


    

    function editAlbum($id, $nombre, $autor, $fecha) {

        $query = $this->db->prepare('UPDATE albumes SET nombre = ?, autor = ?, fecha = ? WHERE id = ?');
        $query->execute([$nombre, $autor, $fecha, $id]);

    }


    function getCancionesByAlbum($id){
        $query = $this->db->prepare('SELECT a.*,b.nombre FROM canciones a INNER JOIN albumes b ON a.Album_fk = b.id WHERE b.id = ?');
        $query->execute([$id]);
        $canciones = $query->fetchAll(PDO::FETCH_OBJ);
        return $canciones;
    }

}
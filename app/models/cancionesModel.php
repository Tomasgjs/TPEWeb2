<?php
require_once './app/models/model.php';

class CancionesModel extends Model{
    private $db;

    function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=db_cancionero;charset=utf8', 'root', '');
    }

    function getCanciones(){
        $query = $this->db->prepare('SELECT a.*, b.nombre AS album_nombre FROM canciones a INNER JOIN albumes b ON a.Album_fk = b.id');
        $query->execute();

        $canciones = $query->fetchAll(PDO::FETCH_OBJ);
        return $canciones;
    }

    function getCancion($id){
        $query = $this->db->prepare('SELECT a.*,b.nombre AS album_nombre FROM canciones a INNER JOIN albumes b ON a.Album_fk = b.id WHERE a.id = ?');
        $query->execute([$id]);
        $canciones = $query->fetch(PDO::FETCH_OBJ);
        return $canciones;
    }

    public function getCancionById($id) {
        $query = $this->db->prepare('SELECT * FROM canciones WHERE id = ?');
        $query->execute([$id]);

        $cancion = $query->fetch(PDO::FETCH_OBJ);
        return $cancion;
    }

    function insertCancion($nombre, $duracion, $Album_fk) {
        $query = $this->db->prepare('INSERT INTO canciones (Nombre, Duracion, Album_fk) VALUES(?,?,?)');
        $query->execute([$nombre, $duracion, $Album_fk]);

        return $this->db->lastInsertId();
    }

    function removeCancion($id) {
        $query = $this->db->prepare('DELETE FROM canciones WHERE id = ?');
        $query->execute([$id]);
    }

    function editCancion($id, $nombre, $duracion, $album) {
        $query = $this->db->prepare('UPDATE canciones SET Nombre = ?, Duracion = ?, Album_fk = ? WHERE id = ?');
        $query->execute([$nombre, $duracion, $album, $id]);
    }
}
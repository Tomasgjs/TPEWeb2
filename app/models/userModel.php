<?php

class UserModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_cancionero;charset=utf8', 'root', '');
    }

    public function getByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM user WHERE username = ?');
        $query->execute([$username]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
}
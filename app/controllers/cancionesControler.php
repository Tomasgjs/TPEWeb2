<?php
require_once './app/models/cancionesModel.php';
require_once './app/views/cancionesView.php';
require_once './helpers/auth.helper.php';

class CancionesController {
    private $model;
    private $view;

    public function __construct(){
        AuthHelper::verify();
    
        $this->model = new CancionesModel();
        $this->view = new CancionesView();
    }

    public function showCanciones(){
        $canciones = $this->model->getCanciones();
        $this->view->showCanciones($canciones);
    }

    public function addCancion() {
        $nombre = $_POST['nombre'];
        $duracion = $_POST['duracion'];
        $album = $_POST['album'];

        if (empty($nombre) || empty($duracion) || empty($album)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertCancion($nombre, $duracion, $album);
        if ($id) {
            header('Location: ' . BASE_URL . 'cancion');
        } else {
            $this->view->showError("Error al insertar la cancion");
        }
    }

    public function deleteCancion($id) {
        $this->model->removeCancion($id);
        header('Location: ' . BASE_URL . 'canciones');
    }

    public function updateCancion(){
        $id = $_POST['id'];

        $cancionActual = $this->model->getCancionById($id);

        $nombre = (!empty($_POST['nombre']) && $_POST['nombre'] !== "") ? $_POST['nombre'] : $cancionActual->nombre;
        $duracion = (!empty($_POST['duracion']) && $_POST['duracion'] !== "") ? $_POST['duracion'] : $cancionActual->duracion;
        $fecha = (!empty($_POST['album']) && $_POST['album'] !== "") ? $_POST['album'] : $cancionActual->album;

        $this->model->editCancion($id, $nombre, $duracion, $album);
            header('Location: ' . BASE_URL . 'cancion');

    }
}


<?php
require_once './app/models/cancionesModel.php';
require_once './app/views/cancionesView.php';
require_once './helpers/auth.helper.php';
require_once './app/models/album.model.php';

class CancionesController {
    private $model;
    private $view;
    private $albumModel;

    public function __construct(){
        AuthHelper::verify();
    
        $this->model = new CancionesModel();
        $this->view = new CancionesView();
        $this->albumModel = new AlbumModel();
    }

    public function showCanciones(){
        $canciones = $this->model->getCanciones();
        $albums = $this->albumModel->getAlbums();
        $this->view->showCanciones($canciones, $albums);
    }

    public function showCancionById($id){
        $cancion = $this->model->getCancionById($id);
        $this->view->showCancion($cancion);
    }

    public function addCancion() {
        $nombre = $_POST['nombre'];
        $duracion = $_POST['duracion'];
        $Album_fk = $_POST['Album_fk'];

        if (empty($nombre) || empty($duracion) || empty($Album_fk)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertCancion($nombre, $duracion, $Album_fk);
        if ($id) {
            header('Location: ' . BASE_URL . 'canciones');
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

        $nombre = (!empty($_POST['nombre']) && $_POST['nombre'] !== "") ? $_POST['nombre'] : $cancionActual->Nombre;
        $duracion = (!empty($_POST['duracion']) && $_POST['duracion'] !== "") ? $_POST['duracion'] : $cancionActual->Duracion;
        $album = $_POST['album'];
        
        $this->model->editCancion($id, $nombre, $duracion, $album);
            header('Location: ' . BASE_URL . 'canciones');
    }
}


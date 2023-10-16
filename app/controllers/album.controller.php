<?php
require_once './app/models/album.model.php';
require_once './app/views/album.view.php';
require_once './helpers/auth.helper.php';


class AlbumController {
    private $view;
    private $model;
    function __construct() {
        $this->model = new AlbumModel();
        $this->view = new AlbumView();
    } 

    public function showAlbums() {
        $albums = $this->model->getAlbums();
        $this->view->showAlbums($albums);
    }


    public function addAlbum() {

        // obtengo los datos del usuario
        $nombre = $_POST['nombre'];
        $autor = $_POST['autor'];
        $fecha = $_POST['fecha'];


        // validaciones
        if (empty($nombre) || empty($fecha) || empty($autor)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertAlbum($nombre, $autor, $fecha);
        if ($id) {
            header('Location: ' . BASE_URL . 'albums');
        } else {
            $this->view->showError("Error al insertar el album");
        }
    }
    public function showCancionesByAlbum($id){
        $canciones = $this->model->getCancionesByAlbum($id);
        $nombreAlbum = $this->model->getAlbumById($id)->nombre;
        $this->view->showCancionesByAlbum($canciones, $nombreAlbum);

    }
    
    public function deleteAlbum($id) {

        $this->model->removeAlbum($id);
        header('Location: ' . BASE_URL . 'albums');
    }
    public function updateAlbum(){

        // obtengo los datos del usuario
        $id = $_POST['id'];


        

        $albumActual = $this->model->getAlbumById($id);
        // Obtiene los nuevos valores del formulario
        
        
        $nombre = (!empty($_POST['nombre']) && $_POST['nombre'] !== "") ? $_POST['nombre'] : $albumActual->nombre;
        $autor = (!empty($_POST['autor']) && $_POST['autor'] !== "") ? $_POST['autor'] : $albumActual->autor;
        $fecha = (!empty($_POST['fecha']) && $_POST['fecha'] !== "") ? $_POST['fecha'] : $albumActual->fecha;


    
        $this->model->editAlbum($id, $nombre, $autor, $fecha);
            header('Location: ' . BASE_URL . 'albums');

    }


}
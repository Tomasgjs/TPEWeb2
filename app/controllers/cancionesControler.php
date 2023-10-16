<?php

class CancionesController {
    private $model;
    private $view;

    public function __construct(){
        AuthHelper::verify();
    
        $this->model = new CancionesModel();
        $this->view = new CancionesView();
    }

    public function showHome(){
        $canciones = $this->model->getCanciones();
        $this->view->showCanciones($canciones);
    }
}


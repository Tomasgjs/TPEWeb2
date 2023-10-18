<?php
require_once './helpers/auth.helper.php';
require_once './app/views/home.view.php';
require_once './app/models/model.php';

    class AuthController {
    private $view;
    private $model;
    public function __construct() {
        $this->view = new AuthView();
        $this->model = new UserModel();
    } 

    }
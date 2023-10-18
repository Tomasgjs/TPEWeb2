<?php
require_once './helpers/auth.helper.php';
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/models/model.php';

    class AuthController {
    private $view;
    private $model;
    public function __construct() {
        $this->view = new AuthView();
        $this->model = new UserModel();
    } 

    public function showLogin(){
        $this->view->showLogin();
    }


    public function auth() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        // busco el usuario
        $user = $this->model->getByUsername($username);

        if ($user && password_verify($password, $user->password)) {
            // ACA LO AUTENTIQUE
            
            AuthHelper::login($user);
            header('Location: ' . BASE_URL . 'albums');

        } else {
            $this->view->showLogin('Usuario inválido');
        }
    }
    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL . 'albums');    
    }
}


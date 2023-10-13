<?php

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// home    ->           CancionController->showHome();
// agregar   ->         CancionController->addCancion();
// eliminar/:ID  ->     CancionController->removeCancion($id); 
// login ->             AuthContoller->showLogin();
// logout ->            AuthContoller->logout();
// auth                 AuthContoller->auth(); // toma los datos del post y autentica al usuario


$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new CancionController();
        $controller->showHome();
        break;
    case 'agregar':
        $controller = new CancionController();
        $controller->addCancion();
        break;
    case 'eliminar':
        $controller = new TaskController();
        $controller->removeCancion($params[1]);
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        $controller->showError();
        break;
}
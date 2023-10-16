<?php
require_once './app/controllers/cancionesController.php'
require_once './app/controllers/album.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

// home    ->           homeController->showHome();
// cancion   ->         CancionController->showCanciones();
// agregar   ->         CancionController->addCancion();
// eliminar/:ID  ->     CancionController->removeCancion($id); 
// login ->             AuthContoller->showLogin();
// logout ->            AuthContoller->logout();
// auth                 AuthContoller->auth(); // toma los datos del post y autentica al usuario


$params = explode('/', $action);

switch ($params[0]) {
    case 'albums':
        $controller = new AlbumController();
        $controller->showAlbums();
        break;
    case 'addAlbum':
        $controller = new AlbumController();
        $controller->addAlbum();
        break;        
    case 'deleteAlbum':
        $controller = new AlbumController();
        $controller->deleteAlbum($params[1]);
        break;
    case 'updateAlbum':
        $controller = new AlbumController();
        $controller->updateAlbum();
        break;
    case 'album':
        $controller = new AlbumController();
        $controller->showCancionesByAlbum($params[1]);
        break;
    case 'cancion':
        $controller = new CancionController();
        $controller->showCanciones();
        break;
    case 'addCancion':
        $controller = new CancionController();
        $controller->addCancion();
        break;
    case 'deleteCancion':
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
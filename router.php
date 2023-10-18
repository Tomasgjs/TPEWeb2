<?php
require_once 'config.php';
require_once './app/controllers/cancionesController.php';
require_once './app/controllers/album.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'albums'; // accion por defecto
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
//album controllers
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
//canciones controllers
    case 'canciones':
        $controller = new CancionesController();
        $controller->showCanciones();
        break;
    case 'addCancion':
        $controller = new CancionesController();
        $controller->addCancion();
        break;
    case 'deleteCancion':
        $controller = new CancionesController();
        $controller->deleteCancion($params[1]);
        break;
    case 'editCancion':
        $controller = new CancionesController();
        $controller->updateCancion($params[1]);
        break;
    case 'cancion':
        $controller = new CancionesController();
        $controller->showCancionById($params[1]);
        break;
//user controllers
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
                                    //     $controller = new AuthController();
                                    //     $controller->showError();
        echo "404 Page Not Found";
        break;

}
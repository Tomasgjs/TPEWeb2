<?php

require_once './app/controllers/album.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

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


}
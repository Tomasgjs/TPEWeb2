<?php

class AlbumView {
    public function showAlbums($albums) {
        $count = count($albums);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion

        // mostrar el template
        require 'templates/album.phtml';
    }



    public function showError($error) {
        require 'templates/error.phtml';
    }

    public function showCancionesByAlbum($canciones, $nombreAlbum) {
        require 'templates/cancion_by_album.phtml';

    

    }
}
<?php

class AlbumView {
    public function showAlbums($albums) {

        require 'templates/album.phtml';
    }



    public function showError($error) {
        require 'templates/error.phtml';
    }

    public function showCancionesByAlbum($canciones, $nombreAlbum) {
        require 'templates/cancion_by_album.phtml';

    

    }
}
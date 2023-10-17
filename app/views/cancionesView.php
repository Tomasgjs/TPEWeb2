<?php

class CancionesView {

    public function showCanciones($canciones, $albums) {
        require 'templates/canciones.phtml';
    }

    public function showCancion($cancion){
        require 'templates/cancion.phtml';
    }
}

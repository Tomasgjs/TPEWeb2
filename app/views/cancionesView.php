<?php

class CancionesView {
    public function showCanciones($canciones) {
        $count = count($canciones);

        require 'templates/canciones.phtml';
    }
}

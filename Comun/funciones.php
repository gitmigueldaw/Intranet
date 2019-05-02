<?php

function filtrado($dato) {
    $dato = trim($dato);
    $dato = stripcslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

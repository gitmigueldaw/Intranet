<?php

include_once 'modelo/Modelo.php';
include_once 'funciones/funciones.php';

session_start();

$pdo = PatronSingleton::getSingleton();

// Para modificar
if (isset($_POST['isbn'])) {

    $id = filtrado($_POST['id']);
    $isbn = filtrado($_POST['isbn']);
    $titulo = filtrado($_POST['titulo']);
    $editorial = filtrado($_POST['editorial']);
    $estado = pon_br_a_saltos_de_linea(filtrado($_POST['estado']));
    $precio = filtrado($_POST['precio']);

    if ($pdo->UPDATE_anuncio($id, $isbn, $titulo, $editorial, $estado, $precio) == 1) {
        echo "modificado";
    } else {
        echo "no_modificado";
    }

    // Para borrar
} else if (isset($_POST['borrarlo'])) {
    
    $id = filtrado($_POST['borrarlo']);

    if ($pdo->DELETE_anuncio($id) == 1) {
      
        borrarImagenes($id, "no_desde_index");
        echo "borrado";
    } else {
        echo "no_borrado";
    }
}
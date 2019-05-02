<?php

include_once 'modelo/Modelo.php';
include_once 'funciones/funciones.php';

session_start();

$pdo = PatronSingleton::getSingleton();

// Desde ajax que comprueba si existe el usuario con ese email
if (isset($_POST['correoLogin'])) {
    $vendedor = $pdo->SELECT_vendedor(filtrado($_POST['correoLogin']));

    // Si no existe
    if ($vendedor == null) {
        echo 'no_registrado';
    }
}

// Desde ajax que comprueba si el pass corresponde al usuario con ese email
if (isset($_POST['passLogin'])) {
    $vendedor = $pdo->SELECT_vendedor(filtrado($_POST['correoLogin']), filtrado($_POST['passLogin']));

    // Si la contraseña no coincide
    if ($vendedor == null) {
        echo 'no_concuerda';
    } else {
        echo 'pass_ok';
    }
}


// Si se ha pulsado el botón de acceder, el cual solo estará habilitado cuando el email exista
// y la contraseña se la correspondiente a ese email
if (isset($_POST['btnSubmitLog'])) {
    // Guardar en sesión al vendedor
    $vendedor = $pdo->SELECT_vendedor(filtrado($_POST['email']), filtrado($_POST['pass']));
    $_SESSION['logeado_alu_com'] = $vendedor;

    header('Location: ../../index.php?alu_com');  
}

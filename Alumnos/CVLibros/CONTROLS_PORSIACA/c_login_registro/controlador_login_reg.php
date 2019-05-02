<?php

include_once '../../modelo/Modelo.php';

session_start();

$pdo = PatronSingleton::getSingleton();

// Si no hay usuario logeado
if (!isset($_SESSION['logeado_alu_com'])) {

    if ($_GET['tipo'] == 'login') {
        include '../../vista/v_login_registro/login_vista.php';
        
    } else if ($_GET['tipo'] == 'registro') {
        include '../../vista/v_login_registro/reg_vista.php';
        
        // Mandar al index si se llega aquí manualmente a través de la URL
    } else {
        header('Location: ../../index.php');
    }

    // Si si hay un logeado, mandar al index
} else {
    header('Location: ../../index.php');
}
?>

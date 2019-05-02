<?php

include_once 'Alumnos/CVLibros/modelo/Modelo.php';
//include_once 'controlador/funciones/funciones.php';

$pdo = PatronSingleton::getSingleton();
$rangos = $pdo->SELECT_rangos_con_anuncios();

// Cerrar sesión
if (isset($_GET['cerrarsesion_alu_com'])) {
    unset($_SESSION['logeado_alu_com']);
    header("Location: ?alu_com");
//    include 'Alumnos/CVLibros/vista/v_index/index_vista_anonimo.php';

    // Vista si se está logeado
} else if (isset($_SESSION['logeado_alu_com'])) {
    include 'Alumnos/CVLibros/vista/v_index/index_vista_logeado.php';

    // Vista anónima
} else {
    include 'Alumnos/CVLibros/vista/v_index/index_vista_anonimo.php';
}


?>

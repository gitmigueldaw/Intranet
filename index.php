<?php

/* Opción sin opción */

if (!$_SERVER['QUERY_STRING'] || $_SERVER['QUERY_STRING'] == 'log') {
    include_once 'Portada/portada.php';
}

/* Opción Inicio */ elseif ($_SERVER['QUERY_STRING'] == 'ini') {
    if (isset($_COOKIE['rol'])) {
        include_once './Comun/cabecera.php';
        include_once './Comun/seccion_1.php';
        include_once './Comun/seccion_2.php';
        include_once './Inicio/seccion_3.php';
        include_once './Inicio/seccion_4.php';
        include_once './Comun/seccion_5.php';
    } else {
        include_once './Comun/error.php';
    }
    /* Opcion contabilidad, el explode es para separar el parametro 
     * dirges de otro parametro que uso para borrar */
} elseif ($_SERVER['QUERY_STRING'] == 'dirges' || explode("&", $_SERVER['QUERY_STRING'])[0] == 'dirges') {
    include_once './Comun/cabecera.php';
    include_once './Comun/seccion_1.php';
    include_once './Comun/seccion_2.php';
    include_once './Direccion/gestion_contable/gestionCont.php';
    include_once './Comun/seccion_5.php';

    /* Opción Compra/Venta de Libros */
} elseif (isset($_GET['alu_com'])) {
    // Para alumnos
    if (isset($_COOKIE['rol']) && ($_COOKIE['rol'] >= 6 && $_COOKIE['rol'] < 30)) {
        include_once './Alumnos/CVLibros/_CONTROLADOR_ALUMNOS.php';
        // Para profesores o más
    } else if (isset($_COOKIE['rol']) && $_COOKIE['rol'] >= 30) {
        include_once './Alumnos/CVLibros/_CONTROLADOR_PROFES.php';
        // Para borrado rápido de anuncio desde enlace por email.
    } else if (isset($_GET['alu_com']) && isset($_GET['borranuncio'])) {
        include_once './Alumnos/CVLibros/borradorapido.php';
    } else {
        include_once './Comun/error.php';
    }








    /* Opcion desconectar */
} elseif ($_SERVER['QUERY_STRING'] == 'desc') {
    //eliminar cookies
    setcookie('rol', '', time() - 3600);
    setcookie('nombre', '', time() - 3600);
    header("Location: ?");
}

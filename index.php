<?php

/* Opción sin opción */

if (!$_SERVER['QUERY_STRING'] || $_SERVER['QUERY_STRING'] == 'log') {
    include_once 'Portada/portada.php';
}

/* Opción Inicio */ 
elseif ($_SERVER['QUERY_STRING'] == 'ini') {
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
    /*Opcion desconectar*/
}elseif ($_SERVER['QUERY_STRING'] == 'desc'){
    //eliminar cookies
    setcookie('rol', '', time() - 3600);
    setcookie('nombre', '', time() - 3600);
    header("Location: ?");
}

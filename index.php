<?php

/* Opción sin opción */

if (!$_SERVER['QUERY_STRING'] || $_SERVER['QUERY_STRING'] == 'log') {
    include_once 'Portada/portada.php';
}

/* Opción Inicio */ elseif ($_SERVER['QUERY_STRING'] == 'ini') {
    if (isset($_COOKIE['rol'])) {
        include_once './Comun/cabecera.php';
        include_once './Inicio/seccion_1.php';
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
    /* Al llegar desde el enlace de email, se ejecuta la línea 47, que recarga este
     * archivo y volvía a entrar por la línea 48 en bucle. Para evitarlo y que entre por la 41, se
     * crea una cookie que impide que entre por la 48 paro que entre por la 39.
     * en cuanto entra por la 39, se borra la cookie para que nadie pueda entrar solo con ?alu_com,
     * ya que la condición de la 39 permitiría entrar.     */
} elseif (isset($_GET['alu_com'])) {
    // Para alumnos
    if (isset($_COOKIE['salirbuclealu_com']) || (isset($_COOKIE['rol']) && ($_COOKIE['rol'] >= 6 && $_COOKIE['rol'] < 30))) {
        setcookie("salirbuclealu_com", "s", time() - 1);
        include_once './Alumnos/CVLibros/_CONTROLADOR_ALUMNOS.php';

        // Para profesores o más
    } else if (isset($_COOKIE['rol']) && $_COOKIE['rol'] >= 30) {
        include_once './Alumnos/CVLibros/_CONTROLADOR_PROFES.php';

        // Para borrado rápido de anuncio desde enlace por email. Sin cookie necesaria
    } else if (isset($_GET['borradoEmail']) && !empty($_GET['borradoEmail']) && !isset($_COOKIE['salirbuclealu_com'])) {
        setcookie("salirbuclealu_com", "s");
        echo "<script>document.location.href='?alu_com&borradoEmail=" . $_GET['borradoEmail'] . "';</script>";
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

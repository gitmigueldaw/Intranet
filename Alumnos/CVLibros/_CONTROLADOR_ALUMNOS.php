<?php

// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Partes genéricas HTML
include_once 'Comun/cabecera.php';
include_once 'Comun/seccion_1.php';
include_once 'Comun/seccion_2.php';

include_once 'modelo/Modelo.php';
include_once 'funciones/funciones.php';
$pdo = PatronSingleton::getSingleton();

//------------------------------------------------------------------------------
if (isset($_GET['logearse'])) {
    // Si no hay usuario logeado
    if (!isset($_SESSION['logeado_alu_com'])) {

        if (!isset($_SESSION['errores_login_alu_com'])) {
            $_SESSION['errores_login_alu_com'] = ['errEmail' => '', 'errPass' => ''];
        }

        if (!isset($_SESSION['datos_login_alu_com'])) {
            $_SESSION['datos_login_alu_com'] = ['email' => '', 'pass' => ''];
        }

        include 'vista/v_login_registro/login_vista.php';

        // Si si hay un logeado, mandar al index
    } else {
        echo "<script>document.location.href='?alu_com';</script>";
    }

//------------------------------------------------------------------------------
} else if (isset($_GET['registrarse'])) {
    // Si no hay usuario logeado
    if (!isset($_SESSION['logeado_alu_com'])) {
        include 'vista/v_login_registro/reg_vista.php';

        // Mandar al index si se llega aquí manualmente a través de la URL
    } else {
        echo "<script>document.location.href='?alu_com';</script>";
    }

    //------------------------------------------------------------------------------
} else if (isset($_GET['registroOK'])) {
    include_once 'vista/mensajes/registro_OK_vista.php';

    //------------------------------------------------------------------------------
} else if (isset($_GET['registroOKmailOK'])) {
    include_once 'vista/mensajes/registroOK_mailOK_vista.php';

    //------------------------------------------------------------------------------
} else if (isset($_GET['anunciocreado']) && isset($_GET['idAnuncio'])) {
    $id = $_GET['idAnuncio'];
    include_once 'vista/mensajes/anuncio_creado_vista.php';

    //------------------------------------------------------------------------------
} else if (isset($_GET['problema'])) {
    include_once 'vista/mensajes/problema_vista.php';
    $_SESSION['MENS_FOTO_alu_com'] = '';

//------------------------------------------------------------------------------
} else if (isset($_GET['nuevoanuncio'])) {
    // Si hay usuario logeado
    if (isset($_SESSION['logeado_alu_com'])) {
        $rangos = $pdo->SELECT_rangos_libros();

        $_SESSION['MENS_FOTO_alu_com'] = '';

        include 'vista/v_anuncio/anuncio_nuevo_CRUD_vista.php';
        // Mandar al index si se llega aquí manualmente a través de la URL
    } else {
        echo "<script>document.location.href='?alu_com';</script>";
    }

//------------------------------------------------------------------------------    
} else if (isset($_GET['veranuncio'])) {

    // Para entrar aquí después de crear un anuncio
    if (isset($_GET['idAnuncio'])) {
        $id = $_GET['idAnuncio'];
        $anuncio = $pdo->SELECT_anuncio($id);

        // Cambiar formato a fecha
        $array = explode('-', $anuncio['fecha']);
        $fechaFormateada = $array[2] . '-' . $array[1] . '-' . $array[0];

        // Asignar dirección de la foto y miniatura
        $dirMiniatura = 'Alumnos/CVLibros/fotos/' . $anuncio['id'] . '/' . $anuncio['id'] . '_mini.jpg';
        $dirFoto = 'Alumnos/CVLibros/fotos/' . $anuncio['id'] . '/' . $anuncio['id'] . '.jpg';

        include 'vista/v_anuncio/anuncio_existente_CRUD_vista.php';

        // Al dar al botón de "Ver anuncio detallado"
    } else if (isset($_POST['btnSubmit'])) {
        $id = $_POST['idAnuncio'];  // $_POST['idAnuncio'] lo crea JS al crear el form al elegir anuncio de la lista

        $anuncio = $pdo->SELECT_anuncio($id);

        // Cambiar formato a fecha
        $array = explode('-', $anuncio['fecha']);
        $fechaFormateada = $array[2] . '-' . $array[1] . '-' . $array[0];

        // Asignar dirección de la foto y miniatura
        $dirMiniatura = 'Alumnos/CVLibros/fotos/' . $anuncio['id'] . '/' . $anuncio['id'] . '_mini.jpg';
        $dirFoto = 'Alumnos/CVLibros/fotos/' . $anuncio['id'] . '/' . $anuncio['id'] . '.jpg';

        // Si el email del anuncio es igual al email del usuario logeado 
        if (isset($_SESSION['logeado_alu_com'])) {
            if (strcmp($anuncio['email_vendedor'], $_SESSION['logeado_alu_com']['email']) == 0) {
                include "vista/v_anuncio/anuncio_existente_CRUD_vista.php";
            } else {
                if ($anuncio['precio'] == 0) {
                    $anuncio['precio'] = 'Consultar';
                }

                include 'vista/v_anuncio/anuncio_VER_vista.php';
            }

            // O la vista simple de consulta de anuncio
        } else {
            if ($anuncio['precio'] == 0) {
                $anuncio['precio'] = 'Consultar';
            }
            include 'vista/v_anuncio/anuncio_VER_vista.php';
        }
    } else {
        echo "<script>document.location.href='?alu_com';</script>";
    }

//------------------------------------------------------------------------------
} else if (isset($_GET['cerrarsesion'])) {
    if (isset($_SESSION['logeado_alu_com'])) {
        unset($_SESSION['logeado_alu_com']);
    }

    // Refrescar. Con header no me deja
    echo "<script>document.location.href='?alu_com';</script>";

//------------------------------------------------------------------------------
    // Pantalla inicial
} else {
    // Lo primero, borrar anuncios viejos
    $viejos = $pdo->SELECT_anuncios_4_meses();

    if (count($viejos) > 0) {
        for ($i = 0; $i < count($viejos); $i++) {
            if ($pdo->DELETE_anuncio($viejos[$i]['id']) == 1) {
                borrarImagenes($viejos[$i]['id']);
            }
        }
    }

    // Borrar mensajes y datos del formulario de login
    if (isset($_SESSION['errores_login_alu_com'])) {
       unset($_SESSION['errores_login_alu_com']);
    }

    if (isset($_SESSION['datos_login_alu_com'])) {
        unset($_SESSION['datos_login_alu_com']);
    }


    // Para el select de categorías.
    $rangos = $pdo->SELECT_rangos_con_anuncios();

    // Vista si se está logeado
    if (isset($_SESSION['logeado_alu_com'])) {
        include 'vista/v_index/index_vista_logeado.php';

        // Vista anónima
    } else {
        include 'vista/v_index/index_vista_anonimo.php';
    }
}

// Partes genéricas
include_once 'Inicio/seccion_4.php';
include_once 'Comun/seccion_5.php';

// echo basename($_SERVER['PHP_SELF']);
?>






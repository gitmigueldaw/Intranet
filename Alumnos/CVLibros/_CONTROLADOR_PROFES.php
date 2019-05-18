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
$pdo = PatronSingleton_CVLibros::getSingleton();

//------------------------------------------------------------------------------
if (isset($_GET['anuncioborrado'])) {
    ?>
    <div class="cuerpo_alu_com">
        <h1>&nbsp;</h1>
        <h2>El anuncio fue borrado con éxito</h2>

        <br><br>

        <a hvr-grow-shadow boton_alu_com href="?alu_com">Ir al índice</a>
    </div>
    <?php
    //------------------------------------------------------------------------------
} else if (isset($_GET['veranuncio'])) {

    if (isset($_POST['btnSubmit'])) {
        $id = $_POST['idAnuncio'];  // $_POST['idAnuncio'] lo crea JS al crear el form al elegir anuncio de la lista

        $anuncio = $pdo->SELECT_anuncio($id);

        // Cambiar formato a fecha
        $array = explode('-', $anuncio['an_fecha']);
        $fechaFormateada = $array[2] . '-' . $array[1] . '-' . $array[0];

        // Asignar dirección de la foto y miniatura
        $dirMiniatura = 'Alumnos/CVLibros/fotos/' . $anuncio['an_id'] . '/' . $anuncio['an_id'] . '_mini.jpg';
        $dirFoto = 'Alumnos/CVLibros/fotos/' . $anuncio['an_id'] . '/' . $anuncio['an_id'] . '.jpg';

        // La vista CRUD
        include "vista/v_anuncio/anuncio_existente_CRUD_vista.php";
    } else {
        echo "<script>document.location.href='?alu_com';</script>";
    }

//------------------------------------------------------------------------------
    // Pantalla inicial
} else {
    // Lo primero, borrar anuncios viejos
    $viejos = $pdo->SELECT_anuncios_4_meses();

    if (count($viejos) > 0) {
        for ($i = 0; $i < count($viejos); $i++) {
            if ($pdo->DELETE_anuncio($viejos[$i]['an_id']) == 1) {
                borrarImagenes($viejos[$i]['an_id']);
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
    include 'vista/profes/index_vista_profes.php';
}

// Partes genéricas
// include_once 'inicio/seccion_4.php';
include_once 'Comun/seccion_5.php';


//    echo basename($_SERVER['PHP_SELF']);
?>



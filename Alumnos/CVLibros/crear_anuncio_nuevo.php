<?php

include_once 'modelo/Modelo.php';
include_once 'funciones/funciones.php';
include_once 'funciones/emails/Email.php';

session_start();

// IMPORTANTE. CUANDO SE INTENTA SUBIR UN FICHERO DE MÁS DE 8MB, EL PROPIO SERVIDOR
// LANZA UN ERROR Y PARA LA EJECUCIÓN. Para solventar esto (líneas 10 a 15):
ob_get_contents();
ob_end_clean();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST) && empty($_FILES) && $_SERVER['CONTENT_LENGTH'] > 0) {
    $_SESSION['MENS_FOTO_alu_com'] = "Imagen demasiado pesada. Máximo 2MB. Se recomienda subir imágenes en formato JPG.";
    echo "<script>document.location.href='../../index.php?alu_com&problema';</script>";
} else {

// Generar id aleatoria para el anuncio al acceder a este PHP
//if (!isset($_SESSION['ID_anuncio_alu_com'])) {
    $_SESSION['ID_anuncio_alu_com'] = crearID_anuncio_random();
//}

    @$rango = filtrado($_POST['categoria']);
    @$isbn = filtrado($_POST['cajaISBN']);
    @$titulo = filtrado($_POST['cajaTITULO']);
    @$estado = filtrado($_POST['cajaESTADO']);
    @$precio = filtrado($_POST['cajaPRECIO']);
    @$editorial = filtrado($_POST['cajaEDITORIAL']);
    @$foto = filtrado($_FILES['archivo_a_subir']['name']);

    // Para que en la tabla se guarden los saltos de línea, en forma de <br>
    $estado = pon_br_a_saltos_de_linea($estado);

    $subidaOK = false;

    if (empty($foto) || $foto = '') {
        $foto = null;
        $subidaOK = true;
    } else {
        $foto = $_SESSION['ID_anuncio_alu_com'];
        $subidaOK = subir_imagen($_SESSION['ID_anuncio_alu_com']);
    }

    if ($subidaOK) {
        $pdo = PatronSingleton::getSingleton();

        // Para la fecha del anuncio
        $date = new DateTime();
        $date = $date->format('Y-m-d');

        if ($pdo->INSERT_anuncio($_SESSION['ID_anuncio_alu_com'], $_SESSION['logeado_alu_com']['ve_email'], $isbn, $titulo, $editorial, $estado, $precio, $rango, $date, $foto) == 1) {
            
            
            
            
            // ¿Mandar email?
            
            
            
            
            
            $idAnuncio = $_SESSION['ID_anuncio_alu_com'];
            unset($_SESSION['ID_anuncio_alu_com']);

            // Ir a mensaje de confirmación
            echo "<script>document.location.href='../../index.php?alu_com&anunciocreado&idAnuncio=" . $idAnuncio . "';</script>";
        } else {
            $_SESSION['MENS_FOTO_alu_com'] = 'No se ha podido crear el anuncio.';
            echo "<script>document.location.href='../../index.php?alu_com&problema';</script>";
        }
    } else {
        echo "<script>document.location.href='../../index.php?alu_com&problema';</script>";
    }
}
?>
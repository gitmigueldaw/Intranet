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
        $pdo = PatronSingleton_CVLibros::getSingleton();

        // Para la fecha del anuncio
        $date = new DateTime();
        $date = $date->format('Y-m-d');

        if ($pdo->INSERT_anuncio($_SESSION['ID_anuncio_alu_com'], $_SESSION['logeado_alu_com']['ve_email'], $isbn, $titulo, $editorial, $estado, $precio, $rango, $date, $foto) == 1) {

            $idAnuncio = $_SESSION['ID_anuncio_alu_com'];
            unset($_SESSION['ID_anuncio_alu_com']);


            // Mandar email
            $cuerpo = '<div style="background-color: white">'
                    . '     <h2 style="color: white; background-color: #448b44; text-align: center; padding: 1% 2vw; border-radius: 1vw">'
                    . '         Información del anuncio'
                    . '     </h2>'
                    . '     <div style="background-color: #e6f3ff; padding: 5% 10% 5% 10%; color: black; border-radius: 1vw">'
                    . '         <h3>Título:</h3> &nbsp;  ' . $titulo . '<br>'
                    . '         <h3>ISBN:</h3> &nbsp;  ' . $isbn . '<br>'
                    . '         <h3>Editorial:</h3> &nbsp;  ' . $editorial . '<br>'
                    . '         <h3>Estado:</h3> &nbsp;  ' . $estado . '<br>'
                    . '         <h3>Precio:</h3> &nbsp;  ' . $precio . '<br>'
                    . '     </div>'
                    . '     <div>'
                    . '         <h2 style="text-align: center; padding: 1% 2vw; background-color: salmon">'
                    . '             Puede borrar rápidamente su anuncio pulsando este enlace: <br> '
                    . '             <a href="http://www.tiernogalvan.es/index.php?alu_com&borradoEmail=s2gtv5s0' . $idAnuncio . 'b7dl9">Borrar anuncio</a>'
                    . '         </h2>'
                    . '         <h2 style="text-align: center; padding: 1% 2vw; background-color: salmon">'
                    . '             No responda a este correo. '
                    . '         </h2>'
                    . '     </div>'
                    . '</div>';


            $mail = new Email($_SESSION['logeado_alu_com']['ve_email'], 'Ha puesto un libro a la venta.', $cuerpo);
            $mail->mandar_correo();

            // Mensajes de confirmación dependiendo de si se mandó el email o no
            if ($mail->getResultado()) {
                echo "<script>document.location.href='../../index.php?alu_com&anunciocreadoMailOK&idAnuncio=" . $idAnuncio . "';</script>";
            } else {
                echo "<script>document.location.href='../../index.php?alu_com&anunciocreado&idAnuncio=" . $idAnuncio . "';</script>";
            }

        } else {
            $_SESSION['MENS_FOTO_alu_com'] = 'No se ha podido crear el anuncio.';
            echo "<script>document.location.href='../../index.php?alu_com&problema';</script>";
        }
    } else {
        echo "<script>document.location.href='../../index.php?alu_com&problema';</script>";
    }
}
?>
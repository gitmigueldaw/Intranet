<?php

include_once '../../modelo/Modelo.php';
include_once '../../controlador/funciones/funciones.php';

session_start();

$pdo = PatronSingleton::getSingleton();


// prueba con un usuario supuestamente logeado.
//$_SESSION['logeado'] = $pdo->SELECT_vendedor('miguel@gmail.com');


// Si se llega desde el botón de "ver anuncio", se cargará la vista simple de ver
// el anuncio, o la vista con el anuncio editable si el usuario que entra es el
// propio vendedor. 
if (isset($_POST['btnSubmit'])) {
    $id = $_POST['idAnuncio'];

    $anuncio = $pdo->SELECT_anuncio($id);

    // Cambiar formato a fecha
    $array = explode('-', $anuncio['fecha']);
    $fechaFormateada = $array[2] . '-' . $array[1] . '-' . $array[0];

    // Asignar dirección de la foto y miniatura
    $dirMiniatura = '../../fotos/' . $anuncio['id'] . '/' . $anuncio['id'] . '_mini.jpg';
    $dirFoto = '../../fotos/' . $anuncio['id'] . '/' . $anuncio['id'] . '.jpg';

    // Si el email del anuncio es igual del email del usuario logeado 
    if (isset($_SESSION['logeado_alu_com'])) {
        if (strcmp($anuncio['email_vendedor'], $_SESSION['logeado_alu_com']['email']) == 0) {
            include '../../vista/v_anuncio/anuncio_existente_CRUD_vista.php';
        }
        
        // O la vista simple de consulta de anuncio
    } else {        
        include '../../vista/v_anuncio/anuncio_VER_vista.php';
    }

    // Si en la url hay "?anuncio=laID", para acceder a un anuncio justo después de crearlo
} else if (isset($_GET['anuncio'])) {
    $anuncio = $pdo->SELECT_anuncio($_GET['anuncio']);

    // Si el email del anuncio es igual del email del usuario logeado 
    if (strcmp($anuncio['email_vendedor'], $_SESSION['logeado_alu_com']['email']) == 0) {
        include '../../vista/v_anuncio/anuncio_existente_CRUD_vista.php';

        // O la vista simple de consulta de anuncio
    } else {
        include '../../vista/v_anuncio/anuncio_VER_vista.php';
    }



    // Si se llega a este php desde la URL, mandar al index
} else {
    header('Location: ?alu_com');
}
?>


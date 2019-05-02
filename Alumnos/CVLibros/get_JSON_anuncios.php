<?php

include_once 'modelo/Modelo.php';

$pdo = PatronSingleton_CVLibros::getSingleton();


if (isset($_POST['rango_alu_com'])) {
    $anuncios = $pdo->SELECT_anuncios_de_rango($_REQUEST['rango_alu_com']);
    echo json_encode($anuncios);
    
    
} else if (isset($_POST['mail_vendedor_alu_com'])) {
    $anuncios = $pdo->SELECT_anuncios_de_vendedor($_REQUEST['mail_vendedor_alu_com']);
    echo json_encode($anuncios);
}

?>

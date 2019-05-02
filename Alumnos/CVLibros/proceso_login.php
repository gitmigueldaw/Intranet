<?php

//echo basename($_SERVER['PHP_SELF']);
//

include_once 'modelo/Modelo.php';
include_once 'funciones/funciones.php';

session_start();

$validez = true;

// Guardar en sesión para cuando se recarge el formulario
$_SESSION['datos_login_alu_com']['email'] = filtrado($_POST['email']);
$_SESSION['datos_login_alu_com']['pass'] = filtrado($_POST['pass']);

$pdo = PatronSingleton_CVLibros::getSingleton();

// Comprobar solo si existe el email
$vendedor = $pdo->SELECT_vendedor(filtrado($_POST['email']));

if ($vendedor == null) {
    $_SESSION['errores_login_alu_com']['errEmail'] = 'Email no registrado.';
    $_SESSION['errores_login_alu_com']['errPass'] = '';
    $validez = false;

    // Comprobar si el pass es correcto
} else {
    $vendedor = $pdo->SELECT_vendedor(filtrado($_POST['email']), filtrado($_POST['pass']));

    if ($vendedor == null) {
        $_SESSION['errores_login_alu_com']['errEmail'] = '';
        $_SESSION['errores_login_alu_com']['errPass'] = 'La contraseña no se corresponde con la del usuario.';
        $validez = false;
    }
}

// Si todo OK
if ($validez) {
    $_SESSION['logeado_alu_com'] = $vendedor;
    echo "<script>document.location.href='../../index.php?alu_com';</script>";
} else {        
    echo "<script>document.location.href='../../index.php?alu_com&logearse';</script>";
}

?>

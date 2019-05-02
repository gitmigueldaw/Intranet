<?php

include_once 'modelo/Modelo.php';
include_once 'funciones/funciones.php';
include_once 'funciones/emails/Email.php';

session_start();

// unset($_SESSION['logeado_alu_con']); // por si hubiera alguien logeado

$pdo = PatronSingleton::getSingleton();

// Para el evento change del campo del email
if (isset($_POST['correo'])) {
    $vendedor = $pdo->SELECT_vendedor(filtrado($_POST['correo']));

    if ($vendedor == null) {
        echo 'disponible';
    } else {
        echo 'ocupado';
    }

    // Para cuando se llega aquí desde el botón submit (porque el form está OK)
} else if (isset($_POST['btnSubmitReg'])) {

    $mail = filtrado($_POST['email']);
    $pass = filtrado($_POST['pass']);
    $nombre = filtrado($_POST['nombre']);
    $telfno = filtrado($_POST['telefono']);

    // Si el teléfono llega vacío, pasar a null
    if (strlen($telfno) == 0) {
        $telfno = null;
    }

    // Si se crea correctamente el vendedor
    if ($pdo->INSERT_vendedor($mail, $pass, $nombre, $telfno) == 1) {

        // Guardar en sesión al usuario recien registrado
        $_SESSION['logeado_alu_com'] = $pdo->SELECT_vendedor($mail);

        // MANDAR EMAIL
        if ($telfno == null) {
            $telfno = 'Sin teléfono registrado.';
        }

        $cuerpo = '<div style="background-color: dimgrey">'
                . '     <h2 style="color: white; background-color: black; text-align: center; padding: 3%">'
                . '         Información sobre su cuenta de vendedor <br> I.E.S Enrique Tierno Galván'
                . '     </h2>'
                . '     <div style="background-color: #dedede; padding: 5% 10% 5% 10%; color: black">'
                . '         <h3>Email:</h3> &nbsp; - ' . $mail . '<br>'
                . '         <h3>Contraseña:</h3> &nbsp; - ' . $pass . '<br>'
                . '         <h3>Nombre de contacto:</h3> &nbsp; - ' . $nombre . '<br>'
                . '         <h3>Teléfono:</h3> &nbsp; - ' . $telfno . '<br>'
                . '     </div>'
                . '     <div>'
                . '         <h2 style="padding: 5%; background-color: salmon">No borre este correo, no podrá recuperar la contraseña si lo pierde.</h2>'
                . '         <h2 style="padding: 5%; background-color: salmon"> No responda a este email. </h2>'
                . '     </div>'
                . '</div>';


        $mail = new Email($mail, 'Se ha creado su cuenta de vendedor.', $cuerpo);     
       // $mail->mandar_correo();

        if ($mail->getResultado()) {
            echo "<script>document.location.href='../../index.php?alu_com&registroOKmailOK';</script>";
        } else {
            echo "<script>document.location.href='../../index.php?alu_com&registroOK';</script>";
        }
    } else {
        echo "<script>document.location.href='../../index.php?alu_com';</script>";
    }
} else {
    echo "<script>document.location.href='../../index.php?alu_com';</script>";
}


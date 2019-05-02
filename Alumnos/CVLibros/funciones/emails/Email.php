<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once 'vendor/autoload.php';
require_once 'vendor/phpmailer/phpmailer/src/Exception.php';
require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';

class Email {

    private $email_remitente;
    private $clave_remitente;
    private $nombre_remitente;
    private $destinatario;
    private $servidor_correo;
    private $asunto;
    private $cuerpo_mensaje;
    private $adjunto;
    private $resultado;

    function __construct($destinatario, $asunto, $cuerpo_mensaje, $adjunto = null) {
        $this->email_remitente = 'iesetgmadrid@gmail.com';
        $this->clave_remitente = 'aglqyp160';
        $this->nombre_remitente = 'App venta de libros';
        $this->servidor_correo = 'smtp.gmail.com';
        $this->destinatario = $destinatario;
        $this->asunto = $asunto;
        $this->cuerpo_mensaje = $cuerpo_mensaje;
        $this->adjunto = $adjunto;
    }

    public function mandar_correo() {
        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';
        $mail->isSMTP();
        $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
        $mail->Host = $this->servidor_correo; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
        $mail->Port = 587; // TLS only: 587  (para SMTP)
        $mail->SMTPSecure = 'tls'; // ssl is depracated
        $mail->SMTPAuth = true;

        $mail->Username = $this->email_remitente;
        $mail->Password = $this->clave_remitente;

        $mail->setFrom($this->email_remitente, $this->nombre_remitente);
        $mail->addAddress($this->destinatario);

        $mail->Subject = $this->asunto;
        $mail->msgHTML($this->cuerpo_mensaje); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
        $mail->AltBody = 'Formato HTML no soportado.';

        if ($this->adjunto != null) {
//            $handle = opendir('./');       
            $mail->addAttachment($this->adjunto, 'adjunto'); // 'images/phpmailer_mini.png'
        }

        if (!$mail->send()) {
            $this->resultado = false;
        } else {
            $this->resultado = true;
        }
    }

    public function getResultado() {
        return $this->resultado;
    }
}

//$mail = new Email('pichake1985@gmail.com', 'Este es el asunto', '<h2>Cuerpo del mensaje</h2>');
//
//$mail->mandar_correo();
//echo $mail->getResultado();

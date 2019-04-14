<?php

class Conexion {

    private $con;

    function __construct() {
        $this->con = new mysqli('localhost', 'root', 'Nohay2sin3', 'basedatos')
                or die("No se ha podido conectar al servidor");
    }

    public function comprobarConexion($usuario, $pass) {
        if ($stmt = $this->con->prepare("SELECT us_codrol, us_cuenta FROM usuarios WHERE us_cuenta = ? AND us_varios = ?")) {
            $stmt->bind_param("ss", $usuario, $pass);
            $stmt->execute();
            $stmt->bind_result($codigo, $nombre);

            $row = $stmt->fetch();
            setcookie("rol", $codigo);
            setcookie("nombre", $nombre);
        } else {
            $row = -1; 
       }
        
        return $row;
    }

}

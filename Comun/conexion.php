<?php

/*
 * Leyendo los datos del fichero "sitio.conf". Abajo está la clase que no lee del fichero.
 * La ruta de "sitio.conf" es desde el directorio raíz, ya que este "Conexion.php" se invoca desde el
 * index. Si se incluye este php en otro archivo que no esté en la raíz, puede fallar al no encontrar
 * "sitio.conf". 
 */

class Conexion {

    private $archivo;
    private $contenido;
    private $servidor;
    private $usuario;
    private $clave;
    private $bd;
    private $con;

    function __construct() {
        $this->setArchivo("Configuraciones/sitio.conf");
        $this->setContenido(parse_ini_file($this->archivo, true));
        $this->setServidor($this->contenido['servidor']);

        $this->setUsuario($this->contenido['usuario_admin']);
        $this->setClave($this->contenido['contrasenia_admin']);
        $this->setBd($this->contenido['nombrebd']);

        $this->con = new mysqli($this->servidor, $this->usuario, $this->clave, $this->bd) or die("No se ha podido conectar al servidor");
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
    
    function getCon() {
        return $this->con;
    }
    
    function setArchivo($archivo) {
        $this->archivo = $archivo;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setServidor($servidor) {
        $this->servidor = $servidor;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    function setBd($bd) {
        $this->bd = $bd;
    }

}

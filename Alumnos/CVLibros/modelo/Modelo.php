<?php

class PatronSingleton {
    private $contenido;
    private $servidor;
    private $usuario;
    private $clave;
    private $bd;

    private $pdo;
    private static $instancia; // contenedor de la instancia

    private function __construct() { // un constructor privado evita crear nuevos objetos desde fuera de la clase
        if (file_exists("Configuraciones/sitio.conf")) {
            $this->setArchivo("Configuraciones/sitio.conf");
        } else if (file_exists("../../Configuraciones/sitio.conf")){
            $this->setArchivo("../../Configuraciones/sitio.conf");
        }

        $this->setContenido(parse_ini_file($this->archivo, true));
        $this->setServidor($this->contenido['servidor']);
        $this->setUsuario($this->contenido['usuario_admin']);
        $this->setClave($this->contenido['contrasenia_admin']);
        $this->setBd($this->contenido['nombrebd']);

	$this->pdo = new PDO("mysql:host=" . $this->servidor . ":3306; dbname=" . $this->bd . "; charset=utf8", $this->usuario, $this->clave);
    }

    public static function getSingleton() { //método singleton que crea instancia sí no está creada       
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;       // __CLASS__ devuelve el nombre de la clase en la que está
            self::$instancia = new $miclase;  // Es igual a     new patronSingleton();
        }
        return self::$instancia;
    }

    public function __clone() { // Sobreescribimos la función __clone. Evita que el objeto se pueda clonar
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
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

    /* ------------------------------------------------------------------------------------------------------------------ */

    public function SELECT_anuncio($idAnuncio) {

        try {
            $prepSentencia = $this->pdo->prepare('SELECT a.*, v.nombre, v.telefono '
                    . 'FROM anuncios a '
                    . 'join vendedores v '
                    . 'on(v.email = a.email_vendedor) '
                    . 'where a.id = :id');

            $prepSentencia->execute([':id' => $idAnuncio]) or die("Ha ocurrido un error al seleccionar anuncios de vendedor.");

            $filasAfectadas = $prepSentencia->rowCount();  // Probado

            if ($filasAfectadas > 0) {
                $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" para indices asociativos y numéricos
                $anuncio = $prepSentencia->fetch();  // fetch() para una fila, fetchAll() para muchas filas (guarda en un array). Se puede usar lo segundo en ambos casos      
            } else {
                $anuncio = null;
            }
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }

        return $anuncio;
    }

    public function SELECT_anuncios_de_rango($idRango) {
        try {
            $prepSentencia = $this->pdo->prepare('select * from anuncios where rango_libro = :rango order by fecha desc');
            $prepSentencia->execute([':rango' => $idRango]) or die("Ha ocurrido un error al seleccionar anuncios de rango de estudios.");

            $filasAfectadas = $prepSentencia->rowCount();  // Probado

            if ($filasAfectadas > 0) {
                $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" indices asociativos y numéricos
                $arrayAnunciosDeRango = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
            } else {
                $arrayAnunciosDeRango = [];
            }
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }

        return $arrayAnunciosDeRango;
    }

    public function SELECT_anuncios_de_vendedor($email) {

        try {
            $prepSentencia = $this->pdo->prepare('select * from anuncios where email_vendedor = :email order by fecha desc');
            $prepSentencia->execute([':email' => $email]) or die("Ha ocurrido un error al seleccionar anuncios de vendedor.");

            $filasAfectadas = $prepSentencia->rowCount();  // Probado

            if ($filasAfectadas > 0) {
                $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" para indices asociativos y numéricos
                $arrayAnunciosDeVendedor = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
            } else {
                $arrayAnunciosDeVendedor = [];
            }
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }

        return $arrayAnunciosDeVendedor;
    }

    function INSERT_anuncio($id, $mail_vende, $isbn, $titulo, $editorial, $estado, $precio, $rango, $fecha, $foto) {
        try {
            $prepSentencia = $this->pdo->prepare('insert into basedatos.anuncios (id, email_vendedor, isbn, titulo, editorial, estado, precio, rango_libro, fecha, foto) '
                    . 'VALUES (:id, :mail, :isbn, :titulo, :editorial, :estado, :precio, :rango, :fecha, :foto)');

            $prepSentencia->execute([
                        ':id' => $id,
                        ':mail' => $mail_vende,
                        ':isbn' => $isbn,
                        ':titulo' => $titulo,
                        ':editorial' => $editorial,
                        ':estado' => $estado,
                        ':precio' => $precio,
                        ':rango' => $rango,
                        ':fecha' => $fecha,
                        ':foto' => $foto
                    ]) or die("Ha ocurrido un error al insertar el anuncio.");

            $filasAfectadas = $prepSentencia->rowCount();
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }
        return $filasAfectadas;
    }

    function UPDATE_anuncio($id, $isbn, $titulo, $editorial, $estado, $precio) {
       
        try {
            $prepSentencia = $this->pdo->prepare('update anuncios '
                    . 'set isbn = :isbn, '
                    . 'titulo = :titulo, '
                    . 'editorial = :edito, '
                    . 'estado = :estado, '
                    . 'precio = :precio '
                    . 'where id = :id');

            // Dar valor a los :elementos creando un array "al vuelo" con los datos
            $prepSentencia->execute([
                        ':isbn' => $isbn,
                        ':titulo' => $titulo,
                        ':edito' => $editorial,
                        ':estado' => $estado,
                        ':precio' => $precio,
                        ':id' => $id
                    ]) or die("Ha ocurrido un error al modificar el anuncio.");

            $filasAfectadas = $prepSentencia->rowCount();
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }
        return $filasAfectadas;
    }

    function DELETE_anuncio($idAnuncio) {
        try {
            $prepSentencia = $this->pdo->prepare('delete from anuncios where id = :id');
            $prepSentencia->execute([':id' => $idAnuncio]) or die("Ha ocurrido un error al borrar el anuncio.");

            $filasAfectadas = $prepSentencia->rowCount();

        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }
        return $filasAfectadas;
    }

    public function SELECT_anuncios_4_meses() {
        try {
            $prepSentencia = $this->pdo->prepare('select * from anuncios '
                    . 'where fecha < CURRENT_TIMESTAMP - INTERVAL 4 MONTH');
            $prepSentencia->execute() or die("Ha ocurrido un error al seleccionar anuncios con más de 4 meses.");

            $filasAfectadas = $prepSentencia->rowCount();  // Probado

            if ($filasAfectadas > 0) {
                $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" para indices asociativos y numéricos
                $arrayAnunciosAntiguos = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
            } else {
                $arrayAnunciosAntiguos = [];
            }
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }

        return $arrayAnunciosAntiguos;
    }

    //*****************************************************************************************************

    public function SELECT_rangos_libros() {
        try {
            $prepSentencia = $this->pdo->prepare('select * from rangos_libros');
            $prepSentencia->execute() or die("Ha ocurrido un error al seleccionar los rangos.");

            $filasAfectadas = $prepSentencia->rowCount();  // Probado

            if ($filasAfectadas > 0) {
                $prepSentencia->setFetchMode(PDO::FETCH_BOTH);  // o "PDO::FETCH_ASSOC" para solo indices asociativos 
                $arrayRangos = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
            } else {
                $arrayRangos = [];
            }
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }

        return $arrayRangos;
    }

    public function SELECT_rangos_con_anuncios() {
        try {
            $prepSentencia = $this->pdo->prepare('SELECT distinct r.* 
                FROM rangos_libros r 
                join anuncios a 
                on (a.rango_libro = r.id);'
            );

            $prepSentencia->execute() or die("Ha ocurrido un error al seleccionar los rangos.");

            $filasAfectadas = $prepSentencia->rowCount();  // Probado

            if ($filasAfectadas > 0) {
                $prepSentencia->setFetchMode(PDO::FETCH_BOTH);  // o "PDO::FETCH_ASSOC" para solo indices asociativos 
                $arrayRangos = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
            } else {
                $arrayRangos = [];
            }
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }

        return $arrayRangos;
    }

    //****************************************************************************************************


    /* Solo nombre: comprobar si existe para no registrar otro con mismo nombre.
     * Con pass, para validar el login de un usuario */
    function SELECT_vendedor($email, $pass = null) {
        try {
            $prepSentencia = $this->pdo->prepare('select * from vendedores where email = :mail');
            $prepSentencia->execute([':mail' => $email]) or die("Ha ocurrido un error al seleccionar.");
            $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" para indices asociativos y numéricos

            $filasAfectadas = $prepSentencia->rowCount();

            $vendedor = null;

            if ($filasAfectadas > 0) {
                $vendedor = $prepSentencia->fetch();  // fetch() para una fila, fetchAll() para muchas filas (guarda en un array). Se puede usar lo segundo en ambos casos      
                // Para comprobar si el pass es correcto
                if ($pass != null) {
                    $hash_DB = $vendedor['hash_pass'];

                    // Verificar el pass con el hash de la DB
                    if (!password_verify($pass, $hash_DB)) {
                        $vendedor = null;
                    }
                }
            }
        } catch (PDOException $ex) {
            echo ('ERROR: ' . $ex->getMessage());
        } finally {
            $prepSentencia = null;
        }

        return $vendedor;
    }

    function INSERT_vendedor($email, $pass, $nombre, $telefono) {
        try {
            $hash = password_hash($pass, PASSWORD_DEFAULT, [15]);

            $prepSentencia = $this->pdo->prepare('insert into vendedores (email, hash_pass, nombre, telefono) '
                    . 'VALUES (:mail, :password, :nombre, :telefono)');

            $prepSentencia->execute([
                        ':mail' => $email,
                        ':password' => $hash,
                        ':nombre' => $nombre,
                        ':telefono' => $telefono
                    ]) or die("Ha ocurrido un error al insertar el vendedor.");

            $filasAfectadas = $prepSentencia->rowCount();
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }

        return $filasAfectadas;
    }

    function DELETE_vendedor($email) {
        try {
            $prepSentencia = $this->pdo->prepare('delete from vendedores where email = :mail');
            $prepSentencia->execute([':mail' => $email]) or die("Ha ocurrido un error al borrar el vendedor.");

            $filasAfectadas = $prepSentencia->rowCount();
        } catch (PDOException $ex) {
            echo ($ex->getMessage());
        } finally {
            $prepSentencia = null;
        }
        return $filasAfectadas;
    }
}
















//class PatronSingleton {
//    private $pdo;
//    private static $instancia; // contenedor de la instancia
//
//    private function __construct() { // un constructor privado evita crear nuevos objetos desde fuera de la clase
//
//        $this->pdo = new PDO("mysql:host=localhost:3307; dbname=basedatos; charset=utf8", 'useradmin', 'phpp@sswd1819admin');
//        // $this->pdo = new PDO("mysql:host=localhost:3307; dbname=venta_libros; charset=utf8", 'root', 'root');
//    }
//
//    public static function getSingleton() { //método singleton que crea instancia sí no está creada       
//        if (!isset(self::$instancia)) {
//            $miclase = __CLASS__;       // __CLASS__ devuelve el nombre de la clase en la que está
//            self::$instancia = new $miclase;  // Es igual a     new patronSingleton();
//        }
//        return self::$instancia;
//    }
//
//    public function __clone() { // Sobreescribimos la función __clone. Evita que el objeto se pueda clonar
//        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
//    }
//
//    /* ------------------------------------------------------------------------------------------------------------------ */
//
//    public function SELECT_anuncio($idAnuncio) {
//
//        try {
//            $prepSentencia = $this->pdo->prepare('SELECT a.*, v.nombre, v.telefono '
//                    . 'FROM anuncios a '
//                    . 'join vendedores v '
//                    . 'on(v.email = a.email_vendedor) '
//                    . 'where a.id = :id');
//
//            $prepSentencia->execute([':id' => $idAnuncio]) or die("Ha ocurrido un error al seleccionar anuncios de vendedor.");
//
//            $filasAfectadas = $prepSentencia->rowCount();  // Probado
//
//            if ($filasAfectadas > 0) {
//                $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" para indices asociativos y numéricos
//                $anuncio = $prepSentencia->fetch();  // fetch() para una fila, fetchAll() para muchas filas (guarda en un array). Se puede usar lo segundo en ambos casos      
//            } else {
//                $anuncio = null;
//            }
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//
//        return $anuncio;
//    }
//
//    public function SELECT_anuncios_de_rango($idRango) {
//        try {
//            $prepSentencia = $this->pdo->prepare('select * from anuncios where rango_libro = :rango');
//            $prepSentencia->execute([':rango' => $idRango]) or die("Ha ocurrido un error al seleccionar anuncios de rango de estudios.");
//
//            $filasAfectadas = $prepSentencia->rowCount();  // Probado
//
//            if ($filasAfectadas > 0) {
//                $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" indices asociativos y numéricos
//                $arrayAnunciosDeRango = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
//            } else {
//                $arrayAnunciosDeRango = [];
//            }
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//
//        return $arrayAnunciosDeRango;
//    }
//
//    public function SELECT_anuncios_de_vendedor($email) {
//
//        try {
//            $prepSentencia = $this->pdo->prepare('select * from anuncios where email_vendedor = :email');
//            $prepSentencia->execute([':email' => $email]) or die("Ha ocurrido un error al seleccionar anuncios de vendedor.");
//
//            $filasAfectadas = $prepSentencia->rowCount();  // Probado
//
//            if ($filasAfectadas > 0) {
//                $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" para indices asociativos y numéricos
//                $arrayAnunciosDeVendedor = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
//            } else {
//                $arrayAnunciosDeVendedor = [];
//            }
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//
//        return $arrayAnunciosDeVendedor;
//    }
//
//    function INSERT_anuncio($id, $mail_vende, $isbn, $titulo, $editorial, $estado, $precio, $rango, $fecha, $foto) {
//        try {
//            $prepSentencia = $this->pdo->prepare('insert into basedatos.anuncios (id, email_vendedor, isbn, titulo, editorial, estado, precio, rango_libro, fecha, foto) '
//                    . 'VALUES (:id, :mail, :isbn, :titulo, :editorial, :estado, :precio, :rango, :fecha, :foto)');
//
//            $prepSentencia->execute([
//                        ':id' => $id,
//                        ':mail' => $mail_vende,
//                        ':isbn' => $isbn,
//                        ':titulo' => $titulo,
//                        ':editorial' => $editorial,
//                        ':estado' => $estado,
//                        ':precio' => $precio,
//                        ':rango' => $rango,
//                        ':fecha' => $fecha,
//                        ':foto' => $foto
//                    ]) or die("Ha ocurrido un error al insertar el anuncio.");
//
//            $filasAfectadas = $prepSentencia->rowCount();
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//        return $filasAfectadas;
//    }
//
//    function UPDATE_anuncio($id, $isbn, $titulo, $editorial, $estado, $precio) {
//       
//        try {
//            $prepSentencia = $this->pdo->prepare('update anuncios '
//                    . 'set isbn = :isbn, '
//                    . 'titulo = :titulo, '
//                    . 'editorial = :edito, '
//                    . 'estado = :estado, '
//                    . 'precio = :precio '
//                    . 'where id = :id');
//
//            // Dar valor a los :elementos creando un array "al vuelo" con los datos
//            $prepSentencia->execute([
//                        ':isbn' => $isbn,
//                        ':titulo' => $titulo,
//                        ':edito' => $editorial,
//                        ':estado' => $estado,
//                        ':precio' => $precio,
//                        ':id' => $id
//                    ]) or die("Ha ocurrido un error al modificar el anuncio.");
//
//            $filasAfectadas = $prepSentencia->rowCount();
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//        return $filasAfectadas;
//    }
//
//    function DELETE_anuncio($idAnuncio) {
//        try {
//            $prepSentencia = $this->pdo->prepare('delete from anuncios where id = :id');
//            $prepSentencia->execute([':id' => $idAnuncio]) or die("Ha ocurrido un error al borrar el anuncio.");
//
//            $filasAfectadas = $prepSentencia->rowCount();
//
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//        return $filasAfectadas;
//    }
//
//    public function SELECT_anuncios_4_meses() {
//        try {
//            $prepSentencia = $this->pdo->prepare('select * from anuncios '
//                    . 'where fecha < CURRENT_TIMESTAMP - INTERVAL 4 MONTH');
//            $prepSentencia->execute() or die("Ha ocurrido un error al seleccionar anuncios con más de 4 meses.");
//
//            $filasAfectadas = $prepSentencia->rowCount();  // Probado
//
//            if ($filasAfectadas > 0) {
//                $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" para indices asociativos y numéricos
//                $arrayAnunciosAntiguos = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
//            } else {
//                $arrayAnunciosAntiguos = [];
//            }
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//
//        return $arrayAnunciosAntiguos;
//    }
//
//    //*****************************************************************************************************
//
//    public function SELECT_rangos_libros() {
//        try {
//            $prepSentencia = $this->pdo->prepare('select * from rangos_libros');
//            $prepSentencia->execute() or die("Ha ocurrido un error al seleccionar los rangos.");
//
//            $filasAfectadas = $prepSentencia->rowCount();  // Probado
//
//            if ($filasAfectadas > 0) {
//                $prepSentencia->setFetchMode(PDO::FETCH_BOTH);  // o "PDO::FETCH_ASSOC" para solo indices asociativos 
//                $arrayRangos = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
//            } else {
//                $arrayRangos = [];
//            }
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//
//        return $arrayRangos;
//    }
//
//    public function SELECT_rangos_con_anuncios() {
//        try {
//            $prepSentencia = $this->pdo->prepare('SELECT distinct r.* 
//                FROM rangos_libros r 
//                join anuncios a 
//                on (a.rango_libro = r.id);'
//            );
//
//            $prepSentencia->execute() or die("Ha ocurrido un error al seleccionar los rangos.");
//
//            $filasAfectadas = $prepSentencia->rowCount();  // Probado
//
//            if ($filasAfectadas > 0) {
//                $prepSentencia->setFetchMode(PDO::FETCH_BOTH);  // o "PDO::FETCH_ASSOC" para solo indices asociativos 
//                $arrayRangos = $prepSentencia->fetchAll();  // fetchAll() devuelve un array de resultados
//            } else {
//                $arrayRangos = [];
//            }
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//
//        return $arrayRangos;
//    }
//
//    //****************************************************************************************************
//
//
//    /* Solo nombre: comprobar si existe para no registrar otro con mismo nombre.
//     * Con pass, para validar el login de un usuario */
//    function SELECT_vendedor($email, $pass = null) {
//        try {
//            $prepSentencia = $this->pdo->prepare('select * from vendedores where email = :mail');
//            $prepSentencia->execute([':mail' => $email]) or die("Ha ocurrido un error al seleccionar.");
//            $prepSentencia->setFetchMode(PDO::FETCH_ASSOC);  // o "PDO::FETCH_BOTH" para indices asociativos y numéricos
//
//            $filasAfectadas = $prepSentencia->rowCount();
//
//            $vendedor = null;
//
//            if ($filasAfectadas > 0) {
//                $vendedor = $prepSentencia->fetch();  // fetch() para una fila, fetchAll() para muchas filas (guarda en un array). Se puede usar lo segundo en ambos casos      
//                // Para comprobar si el pass es correcto
//                if ($pass != null) {
//                    $hash_DB = $vendedor['hash_pass'];
//
//                    // Verificar el pass con el hash de la DB
//                    if (!password_verify($pass, $hash_DB)) {
//                        $vendedor = null;
//                    }
//                }
//            }
//        } catch (PDOException $ex) {
//            echo ('ERROR: ' . $ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//
//        return $vendedor;
//    }
//
//    function INSERT_vendedor($email, $pass, $nombre, $telefono) {
//        try {
//            $hash = password_hash($pass, PASSWORD_DEFAULT, [15]);
//
//            $prepSentencia = $this->pdo->prepare('insert into vendedores (email, hash_pass, nombre, telefono) '
//                    . 'VALUES (:mail, :password, :nombre, :telefono)');
//
//            $prepSentencia->execute([
//                        ':mail' => $email,
//                        ':password' => $hash,
//                        ':nombre' => $nombre,
//                        ':telefono' => $telefono
//                    ]) or die("Ha ocurrido un error al insertar el vendedor.");
//
//            $filasAfectadas = $prepSentencia->rowCount();
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//
//        return $filasAfectadas;
//    }
//
//    function DELETE_vendedor($email) {
//        try {
//            $prepSentencia = $this->pdo->prepare('delete from vendedores where email = :mail');
//            $prepSentencia->execute([':mail' => $email]) or die("Ha ocurrido un error al borrar el vendedor.");
//
//            $filasAfectadas = $prepSentencia->rowCount();
//        } catch (PDOException $ex) {
//            echo ($ex->getMessage());
//        } finally {
//            $prepSentencia = null;
//        }
//
//        return $filasAfectadas;
//    }
//}


?>
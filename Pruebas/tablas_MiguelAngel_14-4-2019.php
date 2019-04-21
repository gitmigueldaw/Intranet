<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8" > 
   <title>Crear base de datos</title>
</head>
<body>
<br>
<?php

$archivo   = "../Configuraciones/sitio.conf";
$contenido = parse_ini_file($archivo, true);
$equipo    = $contenido["servidor"];
$bd        = $contenido["nombrebd"];
$usuario   = $contenido["usuario_admin"];
$clave     = $contenido["contrasenia_admin"];

//									Conexión a MySQL
 $con = mysqli_connect($equipo, $usuario, $clave) or
        die("No se pudo establecer la conexión con el servidor MySQL");
 echo "Conexión establecida.<br>";



 $sql = "CREATE TABLE basedatos.rangos_libros (" .
    "id int NOT NULL, " .
    "rango varchar(60) DEFAULT NULL, " .
    "PRIMARY KEY (id)" .
    ") ENGINE = InnoDB DEFAULT CHARSET = utf8;";

 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de rangos_libros:' . mysqli_error($con));
 };

 echo "Se ha creado la tabla de rangos_libros<br>";



$sql = "CREATE TABLE basedatos.vendedores (" .  
  "email varchar(60) NOT NULL, " .
  "hash_pass varchar(200) NOT NULL, " .
  "nombre varchar(45) NOT NULL, " .
  "telefono int(11) DEFAULT NULL, " .
  "PRIMARY KEY (email) " .
") ENGINE=InnoDB DEFAULT CHARSET = utf8;"; 

if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de vendedoress:' . mysqli_error($con));
 };

 echo "Se ha creado la tabla de vendedores<br>";


$sql = "CREATE TABLE basedatos.anuncios (" .  
  "id varchar(35) NOT NULL, " .
  "email_vendedor varchar(60) NOT NULL, " .
  "isbn varchar(45) DEFAULT ' - ', " .
  "titulo varchar(100) DEFAULT NULL, " .
  "editorial varchar(45) DEFAULT NULL, " .
  "estado varchar(500) DEFAULT NULL, " .
  "precio double DEFAULT NULL, " .
  "rango_libro int NOT NULL, " .
  "fecha date DEFAULT NULL, " .
  "foto varchar(45) DEFAULT NULL, " .
  "PRIMARY KEY (id), " .
  "FOREIGN KEY (email_vendedor) REFERENCES vendedores (email), " .
  "FOREIGN KEY (rango_libro) REFERENCES rangos_libros (id) " .
  ") ENGINE=InnoDB DEFAULT CHARSET = utf8;"; 

if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de anuncios:' . mysqli_error($con));
 };

 echo "Se ha creado la tabla de anuncios<br>";



 $sql = "INSERT INTO basedatos.rangos_libros (id, rango) VALUES
   ('1', 'E.S.O'),
   ('2', 'Bachillerato'),
   ('3', 'Grado Medio'),
   ('4', 'Grado Superior'),
   ('5', 'Otros');";

 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los rangos de estudios' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los rangos de estudios<br>";



 $sql = 'INSERT INTO basedatos.vendedores (email, hash_pass, nombre, telefono) VALUES
   ("miguel@gmail.com", "$2y$10$J7zsMODu6fFp/PtngpAIouxOltW5Wcpv57vfG..vcfqlTUKTlknqS", "Miguel", "666222999"),
   ("manolo@gmail.com", "$2y$10$bAzWv/q6rfRCQpl6cadLhusco1INKV4Z9c1NtjejE0AOciN25b2I.", "Manolo", "654987321");';

 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los vendedores:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los vendedores<br>";



 $sql = "INSERT INTO basedatos.anuncios (id, email_vendedor, isbn, titulo, editorial, estado, precio, rango_libro, fecha, foto) VALUES " .
   "('350', 'miguel@gmail.com', '000000000' ,'Libro ESO 1', 'Anaya', 'Usado', '12.5', '1', '2019-01-01', null)," .
   "('400', 'miguel@gmail.com', '444444444' ,'Libro ESO con foto', 'Anaya', 'Usado', '16', '1', '2019-03-11', '400')," .
   "('127', 'manolo@gmail.com', default ,'Libro Bach',  'Santillana' ,'Como nuevo', '30', '2', '2019-02-20', '127')," .
   "('300', 'manolo@gmail.com', default ,'Librooo', 'editorial torete', 'Usado, tiene marcas y algunos dibujos', '10', '3', '2019-02-05', '300');";

 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los anuncios:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los anuncios<br>";

?>
</body>
</html>


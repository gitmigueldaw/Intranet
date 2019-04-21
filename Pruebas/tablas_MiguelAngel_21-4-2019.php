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
    "('044af672aa18731d41fd077f14d673', 'manolo@gmail.com', '9788448166441', 'Matemáticas aplicadas a las ciencias sociales', 'McGraw Hill', 'bueno', 14, 2, '2019-05-21', '044af672aa18731d41fd077f14d673'), " .
    "('0af2a99327df339a0b1ae99205c8a2', 'miguel@gmail.com', '', 'Fray Perico y su borrico', 'Barco de Vapor', 'Mítico libro infantil, en perfecto estado.<br>Atiendo Whatsapp o email.', 6, 5, '2019-05-12', '0af2a99327df339a0b1ae99205c8a2'), " .
    "('0b04244f4f894cdfd31b15c4aedd13', 'manolo@gmail.com', '8420713759', 'Química de segundo de bachilerato', 'Anaya', 'Bueno', 5, 2, '2019-04-12', '0b04244f4f894cdfd31b15c4aedd13'), " .
    "('1c5bb2907869dacbae2596d2470981', 'miguel@gmail.com', '', 'Formación y Orientación laboral', 'Editex', 'Muy buen estado', 15, 3, '2019-04-12', '1c5bb2907869dacbae2596d2470981'), " .
    "('1e588253dc617f5bf78e4da392ba24', 'miguel@gmail.com', '', 'Varios libros de 1º de bachillerato', 'Varias', 'Libros no usados ya que por problemas personales no se empezó el curso, se han conservado muy bien y aun se tiene su factura. Son libros de 1 de bachillerato para humanidades o ciencias sociales.', 0, 2, '2019-05-08', '1e588253dc617f5bf78e4da392ba24'), " .
    "('3eb16e30001046573d1867914aa90a', 'manolo@gmail.com', '978-84-680-2894-1', 'Matemáticas', 'Santillana', 'Tiene algunos dibujos y los ejercicios están resueltos a lápiz.', 0, 1, '2019-05-07', NULL), " .
    "('79e5aa05ee81bfa281e180796f9fef', 'manolo@gmail.com', '', 'Lengua castellana y literatura', 'SM', 'Se venden libros de Lengua de 1 de ESO en buen estado. Interesados contactar conmigo al móvil.', 15, 1, '2019-06-02', '79e5aa05ee81bfa281e180796f9fef'), " .
    "('88ab2eec7f62a49cd96ed0791cc51d', 'miguel@gmail.com', '9788492566297', 'Aplicaciones Informáticas de tratamientos de texto', 'Anaya', 'Buen estado.', 10, 3, '2019-04-16', '88ab2eec7f62a49cd96ed0791cc51d'), " .
    "('8ece6e180699729043ae282fcf27ab', 'manolo@gmail.com', '978-84-307-9010-4', 'Música II', 'Teide', 'Buen estado. Forrado', 12, 1, '2019-04-13', '8ece6e180699729043ae282fcf27ab'), " .
    "('8fc1d850dc24eafd9516d22b699526', 'manolo@gmail.com', '978-84-680-1952-9', 'Física y Química  2º ESO', 'Teide', 'En buen estado', 14, 1, '2019-04-11', '8fc1d850dc24eafd9516d22b699526'), " .
    "('9187f7378331a14b905d6c3c7a6a9d', 'manolo@gmail.com', '', 'Libro de francés de 3º ESO', 'Santillana', 'En buen estado. Forrado.', 10, 1, '2019-05-19', '9187f7378331a14b905d6c3c7a6a9d'), " .
    "('9518b527cdec935c6f91e4055334eb', 'miguel@gmail.com', '', 'Libros del grado Gestión Administrativa', '-', '7 libros de gestión administrativa. Atiendo whatsapp.', 0, 4, '2019-04-25', '9518b527cdec935c6f91e4055334eb'), " .
    "('9c862ae7a2bf417fd3b256393510cc', 'miguel@gmail.com', '', 'Gestión Logística y comercial', 'Paraninfo', 'Casi sin uso', 16, 4, '2019-04-18', '9c862ae7a2bf417fd3b256393510cc'), " .
    "('a44cb771bdf47eb93e57eeafd15de8', 'manolo@gmail.com', '9780190503710', 'Tecnología', 'Oxford', 'Un poco rasgada la portada pero por lo demás muy bien.', 13.5, 1, '2019-05-04', 'a44cb771bdf47eb93e57eeafd15de8'), " .
    "('c6201323d7b44c0058500ab8022fee', 'miguel@gmail.com', '', 'Sistemas operativos en red', 'Paraninfo', 'Sin uso', 20, 3, '2019-04-21', 'c6201323d7b44c0058500ab8022fee'), " .
    "('cc875662a8e83aa7d50186b572594d', 'manolo@gmail.com', '978-84-698-1043-9', 'Geografía e Historia', 'Anaya', 'De segundo de la ESO, en buen estado.', 16, 1, '2019-04-20', 'cc875662a8e83aa7d50186b572594d'), " .
    "('df7ba8846697679071bd96c6c62745', 'manolo@gmail.com', '9788466773195', 'Filosofía y Ciudadanía', 'Anaya', 'Libro 1º bachillerato Filosofía y Ciudadanía', 0, 2, '2019-05-22', NULL), " .
    "('f58b86acc9ca2836c4fc44932fcede', 'miguel@gmail.com', '9788441518186', 'Desarrollo Web con PHP y MySQL', 'ANAYA', 'Marcas de uso', 20, 4, '2019-04-10', 'f58b86acc9ca2836c4fc44932fcede');";

 
 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los anuncios:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los anuncios<br>";

?>
</body>
</html>

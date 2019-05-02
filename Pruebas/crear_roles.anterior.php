<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8" > 
   <title>Crear tabla de roles</title>
</head>
<body>
<br>
<?php
echo "Empezamos que no es poco<br>";
//									Conexión a MySQL
 $con = mysqli_connect("localhost", "useradmin", "phpp@sswd1819admin") or
        die("No se pudo establecer la conexión con el servidor MySQL");
 echo "Conexión establecida.<br>";
//                                                            Selección de base de datos
 $db = mysqli_select_db($con, 'basedatos');
 if (!$db) {
     die ('No se puede seleccionar la B.D. basedatos:' .
          mysqli_error($con));
 };
 echo "¡ Operación de selección perfecta !<br>";

//                   				TABLA DE ROLES
 echo "Procedo a crear la tabla de roles<br>";
 $sql = "CREATE TABLE roles (ro_codigo tinyint(2)  NOT NULL, " .
                            "ro_descri varchar(50) NOT NULL, " .
                            "PRIMARY KEY (ro_codigo)) ENGINE = MYISAM " .
                            "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de roles:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de roles<br>";
 $sql = "INSERT INTO roles (ro_codigo, ro_descri) VALUES
   (0,  'Usuario anónimo'),
   (6,  'Alumno genérico'),
   (10, 'Bolsa de trabajo alumno'),
   (14, 'Padre del AMPA'),
   (18, 'Bolsa de trabajo empresario de un dto.'),
   (22, 'Bolsa de trabajo empresario'),
   (26, 'Reservado: alumno de un departamento'),
   (28, 'Alumno que gestiona la web, opción Alumnos -Inicio'),
   (30, 'Profesor genérico'),
   (40, 'Un profesor concreto'),
   (50, 'Profesor de un departamento concreto'),
   (60, 'Jefe de Departamento'),
   (65, 'Profesor que introduce partes de amonestación'),
   (68, 'Administrador contable'),
   (70, 'Usuario de dirección'),
   (80, 'Un miembro concreto de la dirección'),
   (90, 'TIC'),
   (99, 'root');";
 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los roles' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los roles<br>";
?>
</body>
</html>


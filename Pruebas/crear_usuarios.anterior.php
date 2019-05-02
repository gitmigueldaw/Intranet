<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8" > 
   <title>Crear tabla de usuarios</title>
</head>
<body>
<br>
<?php
echo "Empezamos que no es poco<br>";
//									Conexión a MySQL
 $con = mysqli_connect("localhost", "useradmin", "phpp@sswd1819admin") or
        die("No se pudo establecer la conexión con el servidor MySQL");
 echo "Conexión establecida.<br>";
//							Selección de base de datos: basedatos
 $db = mysqli_select_db($con, 'basedatos');
 if (!$db) {
     die ('No se puede seleccionar la B.D. basedatos:' .
          mysqli_error($con));
 };
 echo "¡ Operación de selección perfecta !<br>";

//									TABLA DE USUARIOS
 echo "Procedo a crear la tabla usuarios<br>";
 $sql = "CREATE TABLE usuarios (us_cuenta VARCHAR(30)  NOT NULL, " .
                               "us_codrol tinyint(2)   NOT NULL, " .
                               "us_contad mediumint(7) NOT NULL, " .
                               "us_varios varchar(32)  NOT NULL, " .
                               "PRIMARY KEY (us_cuenta), " .
                               "FOREIGN KEY (us_codrol) REFERENCES roles(ro_codigo)" .
                               ") ENGINE = MYISAM " .
                               "DEFAULT CHARSET = utf8;";

 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla usuarios:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de usuarios<br>";

 $sql = "INSERT INTO usuarios (us_cuenta, us_codrol, us_contad, us_varios) VALUES
   ('alumno',           6, 0, '".md5('alumno')."'),
   ('alumno_tra',      10, 0, '".md5('alumno_tra')."'),
   ('padre_ampa',      14, 0, '".md5('padre_ampa')."'),
   ('empresario_auto', 18, 0, '".md5('empresario_auto')."'),
   ('empresario_eca',  18, 0, '".md5('empresario_eca')."'),
   ('empresario_frio', 18, 0, '".md5('empresario_frio')."'),
   ('empresario_inf',  18, 0, '".md5('empresario_inf')."'),
   ('empresario',      22, 0, '".md5('empresario')."');";
 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los primeros usuarios:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los primeros usuarios<br>";

 $sql = "INSERT INTO usuarios (us_cuenta, us_codrol, us_contad, us_varios) VALUES " .
                             "('alumno_auto', 26, 0, '" . md5('alumno_auto') . "')," .
                             "('alumno_bio',  26, 0, '" . md5('alumno_bio')  . "')," .
                             "('alumno_dibu', 26, 0, '" . md5('alumno_dibu') . "')," .
                             "('alumno_eco',  26, 0, '" . md5('alumno_eco')  . "')," .
                             "('alumno_efi',  26, 0, '" . md5('alumno_efi')  . "')," .
                             "('alumno_eca',  26, 0, '" . md5('alumno_eca')  . "')," .
                             "('alumno_filo', 26, 0, '" . md5('alumno_filo') . "')," .
                             "('alumno_fyq',  26, 0, '" . md5('alumno_fyq')  . "')," .
                             "('alumno_fra',  26, 0, '" . md5('alumno_fra')  . "')," .
                             "('alumno_frio', 26, 0, '" . md5('alumno_frio') . "')," .
                             "('alumno_fol',  26, 0, '" . md5('alumno_fol')  . "')," .
                             "('alumno_geo',  26, 0, '" . md5('alumno_geo')  . "')," .
                             "('alumno_inf',  26, 0, '" . md5('alumno_inf')  . "')," .
                             "('alumno_ing',  26, 0, '" . md5('alumno_ing')  . "')," .
                             "('alumno_len',  26, 0, '" . md5('alumno_len')  . "')," .
                             "('alumno_lat',  26, 0, '" . md5('alumno_lat')  . "')," .
                             "('alumno_mate', 26, 0, '" . md5('alumno_mate') . "')," .
                             "('alumno_mus',  26, 0, '" . md5('alumno_mus')  . "')," .
                             "('alumno_ori',  26, 0, '" . md5('alumno_ori')  . "')," .
                             "('alumno_reli', 26, 0, '" . md5('alumno_reli') . "')," .
                             "('alumno_ten',  26, 0, '" . md5('alumno_tec')  . "')," .
                             "('alumno_web',  28, 0, '" . md5('alumno_web')  . "');";
 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los usuarios alumnos de departamentos:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los usuarios alumnos de departamentos<br>";

 $sql = "INSERT INTO usuarios (us_cuenta, us_codrol, us_contad, us_varios) VALUES " .
                             "('profe',  30, 0, '" .md5('profe')  . "')," .
                             "('profes', 30, 0, '" .md5('profes') . "');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el usuario profe:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el usuario profe<br>";

 $sql = "INSERT INTO usuarios (us_cuenta, us_codrol, us_contad, us_varios) VALUES " .
                             "('profe_auto', 50, 0, '" . md5('profe_auto') . "')," .
                             "('profe_bio',  50, 0, '" . md5('profe_bio')  . "')," .
                             "('profe_dibu', 50, 0, '" . md5('profe_dibu') . "')," .
                             "('profe_eco',  50, 0, '" . md5('profe_eco')  . "')," .
                             "('profe_efi',  50, 0, '" . md5('profe_efi')  . "')," .
                             "('profe_eca',  50, 0, '" . md5('profe_eca')  . "')," .
                             "('profe_filo', 50, 0, '" . md5('profe_filo') . "')," .
                             "('profe_fyq',  50, 0, '" . md5('profe_fyq')  . "')," .
                             "('profe_fra',  50, 0, '" . md5('profe_fra')  . "')," .
                             "('profe_frio', 50, 0, '" . md5('profe_frio') . "')," .
                             "('profe_fol',  50, 0, '" . md5('profe_fol')  . "')," .
                             "('profe_geo',  50, 0, '" . md5('profe_geo')  . "')," .
                             "('profe_inf',  50, 0, '" . md5('profe_inf')  . "')," .
                             "('profe_ing',  50, 0, '" . md5('profe_ing')  . "')," .
                             "('profe_len',  50, 0, '" . md5('profe_len')  . "')," .
                             "('profe_lat',  50, 0, '" . md5('profe_lat')  . "')," .
                             "('profe_mate', 50, 0, '" . md5('profe_mate') . "')," .
                             "('profe_mus',  50, 0, '" . md5('profe_mus')  . "')," .
                             "('profe_ori',  50, 0, '" . md5('profe_ori')  . "')," .
                             "('profe_reli', 50, 0, '" . md5('profe_reli') . "')," .
                             "('profe_ten',  50, 0, '" . md5('profe_tec')  . "');";
 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los usuarios profesores de departamentos:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los usuarios profesores de departamentos<br>";

 $sql = "INSERT INTO usuarios (us_cuenta, us_codrol, us_contad, us_varios) VALUES " .
                             "('jefe_dto',  60, 0, '" . md5('jefe_dto')  . "')," .
                             "('jefe_auto', 60, 0, '" . md5('jefe_auto') . "')," .
                             "('jefe_bio',  60, 0, '" . md5('jefe_bio')  . "')," .
                             "('jefe_dibu', 60, 0, '" . md5('jefe_dibu') . "')," .
                             "('jefe_eco',  60, 0, '" . md5('jefe_eco')  . "')," .
                             "('jefe_efi',  60, 0, '" . md5('jefe_efi')  . "')," .
                             "('jefe_eca',  60, 0, '" . md5('jefe_eca')  . "')," .
                             "('jefe_filo', 60, 0, '" . md5('jefe_filo') . "')," .
                             "('jefe_fyq',  60, 0, '" . md5('jefe_fyq')  . "')," .
                             "('jefe_fra',  60, 0, '" . md5('jefe_fra')  . "')," .
                             "('jefe_frio', 60, 0, '" . md5('jefe_frio') . "')," .
                             "('jefe_fol',  60, 0, '" . md5('jefe_fol')  . "')," .
                             "('jefe_geo',  60, 0, '" . md5('jefe_geo')  . "')," .
                             "('jefe_inf',  60, 0, '" . md5('jefe_inf')  . "')," .
                             "('jefe_ing',  60, 0, '" . md5('jefe_ing')  . "')," .
                             "('jefe_len',  60, 0, '" . md5('jefe_len')  . "')," .
                             "('jefe_lat',  60, 0, '" . md5('jefe_lat')  . "')," .
                             "('jefe_mate', 60, 0, '" . md5('jefe_mate') . "')," .
                             "('jefe_mus',  60, 0, '" . md5('jefe_mus')  . "')," .
                             "('jefe_ori',  60, 0, '" . md5('jefe_ori')  . "')," .
                             "('jefe_reli', 60, 0, '" . md5('jefe_reli') . "')," .
                             "('jefe_tec',  60, 0, '" . md5('jefe_tec')  . "');";
 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los usuarios jefes de departamentos:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los usuarios jefes de departamentos<br>";

 $sql = "INSERT INTO usuarios (us_cuenta, us_codrol, us_contad, us_varios) VALUES
   ('partes',    65, 0, '".md5('partes')."'),
   ('elena',     68, 0, '".md5('elena')."'),
   ('direccion', 70, 0, '".md5('direccion')."'),
   ('jestudios', 80, 0, '".md5('jestudios')."'),
   ('tic',       90, 0, '".md5('tic')."'),
   ('root',      99, 0, '".md5('root')."');";
 if (!mysqli_query($con, $sql)) {
    die ('No se pueden dar de alta los usuarios privilegiados:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los usuarios privilegiados<br>";

?>
</body>
</html>


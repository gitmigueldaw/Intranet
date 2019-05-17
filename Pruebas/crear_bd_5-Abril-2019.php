<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8" > 
   <title>Crear base de datos</title>
</head>
<body>
<br>
<?php
echo "Empezamos que no es poco<br>";

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

//									Base de datos: basedatos
 echo "Procedo a crear la base de datos <br>";
 $sql = "CREATE DATABASE if not exists $bd " .
                         "DEFAULT CHARACTER SET utf8 " .
                         "DEFAULT COLLATE utf8_general_ci;";
 if (!mysqli_query($con, $sql)) {
     die ('No se puede crear la B.D. basedatos:' .
          mysqli_error($con));
 }
 echo "Base de datos creada <br>";
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
                            "PRIMARY KEY (ro_codigo)) ENGINE = InnoDB " .
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

//									TABLA DE USUARIOS
 echo "Procedo a crear la tabla usuarios<br>";
 $sql = "CREATE TABLE usuarios (us_cuenta VARCHAR(30)  NOT NULL, " .
                               "us_codrol tinyint(2)   NOT NULL, " .
                               "us_contad mediumint(7) NOT NULL, " .
                               "us_varios varchar(32)  NOT NULL, " .
                               "PRIMARY KEY (us_cuenta), " .
                               "FOREIGN KEY (us_codrol) REFERENCES roles(ro_codigo)" .
                               ") ENGINE = InnoDB " .
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

//									TABLA DE DEPARTAMENTOS
 echo "Procedo a crear la tabla de departamentos<br>";
 $sql = "CREATE TABLE departamentos (de_codigo VARCHAR(5)  NOT NULL, " .
                                    "de_descri_es VARCHAR(30) NOT NULL, " .
                                    "de_descri_en VARCHAR(30) NOT NULL, " .
                                    "de_tipo INT(1) NOT NULL," .
                                    "de_url VARCHAR(4) NOT NULL," .
                                    "de_jefe   VARCHAR(9), " .
                                    "PRIMARY KEY (de_codigo)" .
                                    ") ENGINE = InnoDB " .
                                    "DEFAULT CHARSET = utf8;";

 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla departamentos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de departamentos<br>";
 //Insercion de departamentos
 $sql = "INSERT INTO departamentos (de_codigo, de_descri_es,de_descri_en, de_tipo, de_url)
        VALUES ('AUTO',  'Automoción',	               'Self propulsion',           '1', 'aut'),
               ('BIO',   'Biología y Geología',	       'Biology & Geology',         '0', 'bio'),
               ('CAMPE', 'Campeonatos Escolares',      'Campeonatos escolares',     '2', 'cam'),
               ('DIBU',  'Dibujo',                     'Drawing',                   '0', 'dib'),
               ('ECO',   'Economía',                   'Economics',                 '0', 'eco'),
               ('EFISI', 'Educación física',           'Physical education',        '0', 'edu'),
               ('ELECA', 'Electricidad y Electrónica', 'Electricity & Electronics', '1', 'ele'),
               ('EXT',	 'Actividades Extraesc.',      'Out of School Activities',  '0', 'ext'),
               ('FILO',	 'Filosofía',                  'Philosophy',                '0', 'fil'),
               ('FIQUI', 'Física y Química',           'Physics & Chemistry',       '0', 'fis'),
               ('FRAN',	 'Francés',                    'French',                    '0', 'fra'),
               ('FRIO',	 'Frío y calor',               'Hot & cold',                '1', 'fri'),
               ('FOL', 	 'F. O. L.',                   'Training & Guidance',       '1', 'fol'),
               ('GEO',	 'Geografía e Historia',       'Geography & History',       '0', 'geo'),
               ('INFOR', 'Informática',                'Information technology',    '1', 'inf'),
               ('ING',	 'Inglés',                     'English',                   '0', 'ing'),
               ('JESTU', 'Jefatura de Estudios',       'Jefatura de Estudios',      '2', 'jes'),
               ('LEN',	 'Lengua y Literatura',        'Language & Literature',     '0', 'len'),
               ('LAT',	 'Latín',                      'Latin',                     '0', 'lat'),
               ('MATE',	 'Matemáticas',                'Mathematics',               '0', 'mat'),
               ('MUS',	 'Música',                     'Music',                     '0', 'mus'),
               ('ORIEN', 'Orientación',                'Guidance',                  '0', 'ori'),
               ('PCPI',  'P.C.P.I.',                   'P.C.P.I.',                  '2', 'pcp'),
               ('RELI',	 'Religión',                   'Religion',                  '0', 'rel'),
               ('TECNO', 'Tecnología',                 'Technology',                '0', 'tec');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta los departamentos:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los departamento<br>";
//									TABLA DE PROFESORES
 echo "Procedo a crear la tabla de profesores<br>";
 $sql = "CREATE TABLE profesores (pr_codigo VARCHAR(9)  NOT NULL, " .
                                 "pr_nombre VARCHAR(30) NOT NULL, " .
                                 "pr_apell1 VARCHAR(30), " .
                                 "pr_apell2 VARCHAR(30), " .
                                 "pr_direcc VARCHAR(200), " .
                                 "pr_poblac VARCHAR(50), " .
                                 "pr_provin VARCHAR(30), " .
                                 "pr_codpos VARCHAR(5),  " .
                                 "pr_telef1 VARCHAR(12), " .
                                 "pr_telef2 VARCHAR(12), " .
                                 "pr_email  VARCHAR(200), " .
                                 "pr_coddep VARCHAR(5), " .
                                 "pr_cuenta VARCHAR(30), " .
                                 "PRIMARY KEY (pr_codigo), " .
                                 "FOREIGN KEY (pr_coddep) REFERENCES departamentos(de_codigo), " .
                                 "FOREIGN KEY (pr_cuenta) REFERENCES usuarios(us_cuenta)" .
                                 ") ENGINE = InnoDB " .
                                 "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de profesores:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de profesores<br>";

// Se crea la Foreign key de departamentos en profesores
 echo "Procedo a crear la Foreign key de departamentos en profesores<br>";
 $sql = "ALTER TABLE departamentos ADD FOREIGN KEY (de_jefe) REFERENCES profesores(pr_codigo)";
  if (!mysqli_query($con, $sql)) { 
    die ('No se puede crear la clave ajena de departamentos a  profesores:' .
          mysqli_error($con));
  }

//									TABLA DE MOVIMIENTOS
 echo "Procedo a crear la tabla de movimientos<br>";
 $sql = "CREATE TABLE movimientos (mo_id SMALLINT(5) AUTO_INCREMENT, " .
                                  "mo_coddep VARCHAR(5), " .
                                  "mo_fecha  DATE, " .
                                  "mo_concep VARCHAR(50), " .
                                  "mo_import DECIMAL(10,2) NOT NULL, " .
                                  "mo_nummov INT(10), " .
                                  "PRIMARY KEY (mo_id), " .
                                  "FOREIGN KEY (mo_coddep) REFERENCES departamentos(de_codigo)" .
                                  ") ENGINE = InnoDB " .
                                  "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla movimientos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de movimientos<br>";
 $sql = "INSERT INTO movimientos (mo_coddep, mo_fecha, mo_concep, mo_import, mo_nummov) VALUES " .
                                 "('INFOR', '2013-03-18', 'Compra de papel', 235, 5);";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el primer movimiento:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el primer movimiento<br>";

 $sql = "INSERT INTO movimientos (mo_coddep, mo_fecha, mo_concep, mo_import, mo_nummov) VALUES " .
                                 "('INFOR', '2013-03-18', 'á é í ó ú Á É Í Ó Ú ñ Ñ', 123.10, 25);";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el segundo movimiento:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el segundo movimiento<br>";

//									TABLA DE GRUPOS
 echo "Procedo a crear la tabla de grupos<br>";
 $sql = "CREATE TABLE grupos (gr_codigo VARCHAR(5) NOT NULL, " .
                             "gr_descri VARCHAR(50), " .
                             "gr_tutor1 VARCHAR(9), " .
                             "gr_delega INT(11), " .
                             "gr_subdel INT(11), " .
                             "PRIMARY KEY (gr_codigo), " .
                             "FOREIGN KEY (gr_tutor1) REFERENCES profesores(pr_codigo) ".
						
							 //Se pone después de crear alumnos.
							 //	 ", " .
                            //"FOREIGN KEY (gr_delega) REFERENCES alumnos(al_codigo), " .
							// "FOREIGN KEY (gr_subdel) REFERENCES alumnos(al_codigo) 	" .
                             ") ENGINE = InnoDB " .
                             "DEFAULT CHARSET = utf8;";
							 
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de grupos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de grupos<br>";
 $sql = "INSERT INTO grupos (gr_codigo, gr_descri) VALUES ('9521A', 'ASIR. Primer curso');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el grupo 9521A:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el grupo 9521A<br>";
 $sql = "INSERT INTO grupos (gr_codigo, gr_descri) VALUES ('9531A', 'DAW. Segundo curso');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el grupo 9531A:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el grupo 9531A<br>";
//									TABLA DE ASIGNATURAS
 echo "Procedo a crear la tabla de asignaturas<br>";
 $sql = "CREATE TABLE asignaturas (as_codigo VARCHAR(5) NOT NULL, " .
                                  "as_descri VARCHAR(50), " .
                                  "PRIMARY KEY (as_codigo)) ENGINE = InnoDB " .
                                  "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de asignaturas:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de asignaturas<br>";
 $sql = "INSERT INTO asignaturas (as_codigo, as_descri) VALUES ('MATES', 'Matemáticas');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la asignatura MATES:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la asignatura MATES<br>";
 $sql = "INSERT INTO asignaturas (as_codigo, as_descri) VALUES ('ISO', 'Implantación de Sistemas Op.');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la asignatura ISO:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la asignatura ISO<br>";
//									TABLA DE ALUMNOS
 echo "Procedo a crear la tabla de alumnos<br>";
 $sql = "CREATE TABLE IF NOT EXISTS `alumnos` (
  `al_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `al_codgru` varchar(5) DEFAULT NULL,
  `al_nombre` varchar(30) NOT NULL,
  `al_apell1` varchar(30) DEFAULT NULL,
  `al_apell2` varchar(30) DEFAULT NULL,
  `al_direcc` varchar(50) DEFAULT NULL,
  `al_poblac` varchar(50) DEFAULT NULL,
  `al_provin` varchar(30) DEFAULT NULL,
  `al_codpos` varchar(5) DEFAULT NULL,
  `al_telef1` varchar(12) DEFAULT NULL,
  `al_telef2` varchar(12) DEFAULT NULL,
  `al_email` varchar(50) DEFAULT NULL,
  `al_cuenta` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`al_codigo`),
  FOREIGN KEY  (`al_codgru`) REFERENCES grupos (gr_codigo) ,
  FOREIGN KEY (`al_cuenta`) REFERENCES usuarios (us_cuenta)
) ENGINE=InnoDB AUTO_INCREMENT=10234 " .
  "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de alumnos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de alumnos<br>";
 
 $sql = " ALTER TABLE grupos ADD FOREIGN KEY (gr_delega) REFERENCES alumnos(al_codigo); " ;
							
    
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la clave ajena del delegado del grupo a alumnos' .
          mysqli_error($con));
 };
 echo "Se ha creado la clave ajena del delegado del grupo a alumnos <br>";
 
 $sql = " ALTER TABLE grupos ADD FOREIGN KEY (gr_subdel) REFERENCES alumnos(al_codigo) ;	" ;
    
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la clave ajena del subdelegado del grupo a alumnos' .
          mysqli_error($con));
 };
 echo "Se ha creado la clave ajena del subdelegado del grupo a alumnos <br>";
 
 
 echo "ERROR: NO EXISTE la el usuario con la cuenta 11111 <br> "; //lpg: corregir
 /*
 $sql = "INSERT INTO alumnos (al_codigo, al_codgru, al_nombre, al_cuenta) VALUES
                             (10231, '9521A', 'Antonio', '11111');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta al alumno 10231:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el alumno 10231<br>";
 */
 
 $sql = "INSERT INTO alumnos (al_codigo, al_codgru, al_nombre) VALUES (10232, '9531A', 'Sebastián');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta al alumno 10232:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el alumno 10232<br>";
//									TABLA DE SEGUIMIENTO
 echo "Procedo a crear la tabla de seguimiento<br>";
 $sql = "CREATE TABLE seguimiento (se_id     MEDIUMINT(8) AUTO_INCREMENT, " .
                                  "se_coddep VARCHAR(5) NOT NULL, " .
                                  "se_codpro VARCHAR(9) NOT NULL, " .
                                  "se_codasi VARCHAR(5) NOT NULL, " .
                                  "se_codgru VARCHAR(5) NOT NULL, " .
                                  "se_descri VARCHAR(1000) NOT NULL, " .
                                  "se_fechoy TIMESTAMP, " .
                                  "PRIMARY KEY (se_id), " .
                                  "FOREIGN KEY (se_coddep) REFERENCES departamentos(de_codigo), " .
                                  "FOREIGN KEY (se_codpro) REFERENCES profesores(pr_codigo), " .
                                  "FOREIGN KEY (se_codasi) REFERENCES asignaturas(as_codigo), " .
                                  "FOREIGN KEY (se_codgru) REFERENCES grupos(gr_codigo)" .
                                  ") ENGINE = InnoDB " .
                                  "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de seguimiento:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de seguimiento<br>";
 echo "ERROR: NO EXISTE la referencia del profesor IF003, LA TABLA ESTÁ VACÍA <br> "; //lpg: corregir
 /*
 
 $sql = "INSERT INTO seguimiento (se_coddep, se_codpro, se_codasi, se_codgru, se_descri) VALUES
                                 ('INFOR', 'IF003', 'ISO', '9521A', 'Voy por el tema 12');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un registro de seguimiento:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un registro de seguimiento<br>";
 */
//									TABLA DE INCIDENCIAS
 echo "Procedo a crear la tabla de incidencias<br>";
 $sql = "CREATE TABLE incidencias (in_id     INT(11) AUTO_INCREMENT, " .
                                  "in_descri VARCHAR(255) NOT NULL, " .
                                  "PRIMARY KEY (in_id)) ENGINE = InnoDB " .
                                  "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de incidencias:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de incidencias<br>";
 $sql = "INSERT INTO incidencias (in_descri) VALUES ('Fumar dentro del aula');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un registro de incidencias:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un registro de incidencias<br>";
 $sql = "INSERT INTO incidencias (in_descri) VALUES ('Romper intencionadamente mobiliario');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un registro de incidencias:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un registro de incidencias<br>";
//									TABLA DE RECURSOS_TIC
 echo "Procedo a crear la tabla de recursos gestionados por el TIC<br>";
 $sql = "CREATE TABLE recursos_tic (re_codigo VARCHAR(10) NOT NULL, " .
                                   "re_descor VARCHAR(100) NOT NULL, " .
                                   "re_deslar VARCHAR(1000), " .
                                   "re_locali VARCHAR(100), " .
                                   "PRIMARY KEY (re_codigo)" .
                                   ") ENGINE = InnoDB " .
                                   "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de recursos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de recursos<br>";
 $sql = "INSERT INTO recursos_tic (re_codigo, re_descor, re_deslar, re_locali) VALUES " .
                                 "('AULACAF', 'Aula de ordenadores', 'Aula con 17 ordenadores que ...', " .
                                 "'Edificio C Planta primera');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el aula de ordenadores:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el aula de ordenadores<br>";
 $sql = "INSERT INTO recursos_tic (re_codigo, re_descor, re_deslar, re_locali) VALUES " .
                                 "('ORD-BIB-01', 'Ordenador 01 de la biblioteca', 'Marca, modelo, IP ...', " .
                                 "'Edificio A Planta baja. Biblioteca');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta un ordenador:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta un ordenador<br>";
 
//									TABLA DE DENEGADOS
 echo "Procedo a crear la tabla de denegados<br>";
 $sql = "CREATE TABLE denegados (de_codigo INT(5) NOT NULL AUTO_INCREMENT, " .
                                   "de_cuenta VARCHAR(30) NOT NULL, " .
                                   "de_varios VARCHAR(32), " .
                                   "de_ip VARCHAR(32), " .
                                   "PRIMARY KEY (de_codigo)" .
                                   ") ENGINE = InnoDB " .
                                   "DEFAULT CHARSET = utf8;";
if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de denegados:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de denegados<br>";
 
//									TABLA DE ANOMALIAS_TIC
 echo "Procedo a crear la tabla de anomalias tic<br>";
 $sql = "CREATE TABLE IF NOT EXISTS `anomalias_tic` (
                             `at_id` mediumint(8) NOT NULL AUTO_INCREMENT,
                             `at_codpro` varchar(9) NOT NULL,
                             `at_titulo` varchar(50) NOT NULL,
                             `at_descri` varchar(255) NOT NULL,
                             `at_lugar` varchar(100) NOT NULL,
                             `at_respue` varchar(255) NOT NULL,
                             `at_estado` char(1) NOT NULL,
                             `at_fechoy` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                              PRIMARY KEY (`at_id`),
                              KEY `at_codpro` (`at_codpro`)
                              ) ENGINE=InnoDB " .
                              "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
 	die ('No se puede crear la tabla de anomalias tic:' .
 			mysqli_error($con));
 };

//                   				TABLA DE RESERVAS_TIC
 echo "Procedo a crear la tabla de reservas gestionadas por el TIC<br>";
 $sql = "CREATE TABLE reservas_tic (rt_id mediumint(8) AUTO_INCREMENT, " .
				   "rt_recur varchar(10) NOT NULL, " .
				   "rt_fecha date NOT NULL, " .
				   "rt_turno varchar(1) NOT NULL, " .
                                   "rt_hora varchar(1) NOT NULL, " .
				   "rt_codpro varchar(9) NOT NULL, " .
				   "rt_fechoy timestamp  NOT NULL, " .
                                   "PRIMARY KEY (rt_id), " .
				   "FOREIGN KEY (rt_recur) REFERENCES recursos_tic(re_codigo), " .
				   "FOREIGN KEY (rt_codpro) REFERENCES profesores(pr_codigo)" .
                                   ") ENGINE = InnoDB " .
                                   "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de reservas:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de recursos<br>";
 
//                   				TABLA DE RESERVAS_HORARIO
 echo "Procedo a crear la tabla del horario de las reservas<br>";
 $sql = "CREATE TABLE reservas_horario (ho_num_hora varchar(1) NOT NULL, " .
				       "ho_turno varchar(1) NOT NULL, " .
				       "ho_texto varchar(20) NOT NULL, " .
				       "ho_desc_horario varchar(20) NOT NULL, " .
				       "PRIMARY KEY (ho_num_hora,ho_turno)" .
				       ") ENGINE = InnoDB " .
                                       "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de reservas:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de horarios<br>";
 
 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('1', 'M', 'Primera hora', 'de 8:30 a 9:25');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('2', 'M', 'Segunda hora', 'de 9:25 a 10:20');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('3', 'M', 'Tercera hora', 'de 10:20 a 11:15');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('R', 'M', 'Recreo', 'de 11:15 a 11:45');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('4', 'M', 'Cuarta hora', 'de 11:45 a 12:40');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('5', 'M', 'Quinta hora', 'de 12:40 a 13:35');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('6', 'M', 'Sexta hora', 'de 13:35 a 14:30');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('E', 'T', 'Hora extra', 'de 14:35 a 15:30');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('1', 'T', 'Primera hora', 'de 15:30 a 16:25');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('2', 'T', 'Segunda hora', 'de 16:25 a 17:20');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('3', 'T', 'Tercera hora', 'de 17:20 a 18:15');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('R', 'T', 'Recreo', 'de 18:15 a 18:45');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('4', 'T', 'Cuarta hora', 'de 18:45 a 19:40');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('5', 'T', 'Quinta hora', 'de 19:40 a 20:35');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";

 $sql = "INSERT INTO reservas_horario (ho_num_hora, ho_turno, ho_texto, ho_desc_horario) VALUES
                                 ('6', 'T', 'Sexta hora', 'de 20:35 a 21:30');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la reserva:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el horario corectamente"."<br>";
 
 //									TABLA DE OFERTAS
 echo "Procedo a crear la tabla de ofertas<br>";
 $sql = "CREATE TABLE ofertas (of_codigo VARCHAR(15)  NOT NULL, " .
                                 "of_nombreEmpresa VARCHAR(30) NOT NULL, " .
                                 "of_ubicacion VARCHAR(50), " .
				 "of_telefono VARCHAR(50), " .
				 "of_email VARCHAR(50), " .
                                 "of_puestoOfertado VARCHAR(40), " .
                                 "of_descripcion VARCHAR(240), " .
                                 "of_jornada VARCHAR(15), " .
                                 "of_requisitos VARCHAR(240), " .
                                 "of_puestosVacantes INT(2),  " .
                                 "of_fecha date default NULL , " .
                                 "PRIMARY KEY (of_codigo)" .
                                 ") ENGINE = InnoDB " .
                                 "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de ofertas:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de ofertas<br>";
 $sql = "INSERT INTO ofertas (of_codigo, of_nombreEmpresa, of_ubicacion, of_telefono, of_email, of_puestoOfertado, of_descripcion, of_jornada, of_requisitos, of_puestosVacantes, of_fecha) VALUES
                                ('0F001', 'Guapu Tecnologies', 'Avd. de Orovilla Nº54', '94123658952', 'email@gmail.com', 'Programador', 'Empresa busca programador', 'Completa', 'Conocimientos de programación', '1', '2013-06-20');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta la oferta OF001:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta la oferta OF001<br>";
 $sql = "INSERT INTO ofertas (of_codigo, of_nombreEmpresa, of_ubicacion, of_telefono, of_email, of_puestoOfertado, of_descripcion, of_jornada, of_requisitos, of_puestosVacantes, of_fecha) VALUES
                                ('0F002', 'Guapi Tecnologies', 'Avd. de Oro Nº55', '94123658952', 'email2@gmail.com', 'Programadores', 'Empresa busca programadores', 'Media', 'Conocimientos de programación, etc..', '2', '2013-06-22');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta a la oferta 0F002:' .
          mysqli_error($con));
 };
 
//									TABLA DE CURRICULA
 echo "Procedo a crear la tabla de curricula<br>";
 $sql = "CREATE TABLE curricula (cv_dni VARCHAR(13) NOT NULL, " .
                                 "cv_apellido1 VARCHAR(50), " .
				 "cv_apellido2 VARCHAR(40), " .
				 "cv_nombre VARCHAR(30), " .
				 "cv_sexo VARCHAR(6),  " .
				 "cv_estadocivil VARCHAR(15),  " .
                                 "cv_nacionalidad VARCHAR(15),  " .
				 "cv_fechaNacimiento VARCHAR(15), " .
				 "cv_lugardenacimiento VARCHAR(15), " .
				 "cv_paisdenacimiento VARCHAR(15), " .
				 "cv_domicilio VARCHAR(50), " .
				 "cv_codigopostal VARCHAR(15), " .
				 "cv_localidad VARCHAR(15), " .
				 "cv_telefono VARCHAR(15), " .
				 "cv_telefono2 VARCHAR(15), " .
				 "cv_email VARCHAR(240), " .
                                 "cv_estudiossinacabar VARCHAR(15), " .
				 "cv_universidadsinacabar VARCHAR(15), " .
				 "cv_finalprevisto VARCHAR(15), " .
				 "cv_grado VARCHAR(15), " .
				 "cv_estudiosacabados VARCHAR(15), " .
				 "cv_finalizaciondeestudios VARCHAR(15), " .
				 "cv_lugardeestudios VARCHAR(15), " .
				 "cv_lenguamaternna VARCHAR(15), " .
				 "cv_inglesescrito VARCHAR(15), " .
				 "cv_inglesleido VARCHAR(15), " .
				 "cv_inglesoral VARCHAR(15), " .
				 "cv_francesleido VARCHAR(15), " .
				 "cv_francesescito VARCHAR(15), " .
				 "cv_francesoral VARCHAR(15), " .
                                 "PRIMARY KEY (cv_dni) " .
                                 ") ENGINE = InnoDB " .
                                  "DEFAULT CHARSET = utf8;";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla de curricula:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de curricula<br>";
 $sql = "INSERT INTO curricula (cv_dni, cv_apellido1, cv_apellido2, cv_nombre, cv_sexo, cv_nacionalidad, cv_fechaNacimiento, cv_lugardenacimiento, cv_paisdenacimiento, cv_domicilio, cv_codigopostal, cv_localidad, cv_telefono, cv_telefono2, cv_email, cv_estudiossinacabar, cv_universidadsinacabar, cv_finalprevisto, cv_grado, cv_estudiosacabados, cv_finalizaciondeestudios, cv_lugardeestudios, cv_lenguamaternna, cv_inglesescrito, cv_inglesleido, cv_inglesoral, cv_francesleido, cv_francesescito, cv_francesoral) VALUES
                                ('02664987W', 'Chocano', 'del Cerro', 'Ricardo', 'Hombre', 'Española', '04/07/1992', 'Madrid', 'España', 'c/Avenida real 19 2A', '28021', 'Madrid', '918756214', '698742301', 'ricardo.ch.92@hotmail.com', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf', 'dsfcdsf');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta el curriculum 0C001:' .
          mysqli_error($con));
 };
 echo "Se ha dado de alta el curriculum 0C002 <br>";

?>
</body>
</html>


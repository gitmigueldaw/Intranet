<!DOCTYPE html>
<html>
<head>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8" > 
   <title>Crear tabla de departamentos</title>
</head>
<body>
<br>
<?php
echo "Crear tabla de departamentos<br>";
//									Conexión a MySQL
 $con = mysqli_connect("localhost", "useradmin", "phpp@sswd1819admin") or
        die("No se pudo establecer la conexión con el servidor MySQL");
 echo "Conexión establecida.<br>";
//								Selección de base de datos: basedatos
 $db = mysqli_select_db($con, 'basedatos');
 if (!$db) {
     die ('No se puede seleccionar la B.D. basedatos:' .
          mysqli_error($con));
 };
 echo "¡ Operación de selección perfecta !<br>";
//									TABLA DE DEPARTAMENTOS
 echo "Procedo a crear la tabla de departamentos<br>";
 $sql = "CREATE TABLE departamentos (de_codigo VARCHAR(5)  NOT NULL, " .
                                    "de_descri_es VARCHAR(30) NOT NULL, " .
                                    "de_descri_en VARCHAR(30) NOT NULL, " .
                                    "de_tipo INT(1) NOT NULL," .
                                    "de_url VARCHAR(4) NOT NULL," .
                                    "de_jefe   VARCHAR(9), " .
                                    "PRIMARY KEY (de_codigo), " .
                                    "FOREIGN KEY (de_jefe) REFERENCES profesores(pr_codigo)" .
                                    ") ENGINE = MYISAM " .
                                    "DEFAULT CHARSET = utf8;";

 if (!mysqli_query($con, $sql)) {
    die ('No se puede crear la tabla departamentos:' .
          mysqli_error($con));
 };
 echo "Se ha creado la tabla de departamentos<br>";
 //Insercion de departamentos
 $sql = "INSERT INTO departamentos (de_codigo, de_descri_es,de_descri_en, de_tipo, de_url, de_jefe)
        VALUES ('AUTO',  'Automoción',	               'Self propulsion',           '1', 'aut',	'MV3'),
               ('BIO',   'Biología y Geología',	       'Biology & Geology',         '0', 'bio',	''),
               ('CAMPE', 'Campeonatos Escolares',      'Campeonatos escolares',     '2', 'cam', ''),
               ('DIBU',  'Dibujo',                     'Drawing',                   '0', 'dib', ''),
               ('ECO',   'Economía',                   'Economics',                 '0', 'eco', ''),
               ('EFISI', 'Educación física',           'Physical education',        '0', 'edu', ''),
               ('ELECA', 'Electricidad y Electrónica', 'Electricity & Electronics', '1', 'ele', 'EE1'),
               ('EXT',	 'Actividades Extraesc.',      'Out of School Activities',  '0', 'ext', ''),
               ('FILO',	 'Filosofía',                  'Philosophy',                '0', 'fil', ''),
               ('FIQUI', 'Física y Química',           'Physics & Chemistry',       '0', 'fis', ''),
               ('FRAN',	 'Francés',                    'French',                    '0', 'fra', ''),
               ('FRIO',	 'Frío y calor',               'Hot & cold',                '1', 'fri', 'MM1'),
               ('FOL', 	 'F. O. L.',                   'Training & Guidance',       '1', 'fol', ''),
               ('GEO',	 'Geografía e Historia',       'Geography & History',       '0', 'geo', ''),
               ('INFOR', 'Informática',                'Information technology',    '1', 'inf', 'IF003'),
               ('ING',	 'Inglés',                     'English',                   '0', 'ing', ''),
               ('JESTU', 'Jefatura de Estudios',       'Jefatura de Estudios',      '2', 'jes', ''),
               ('LEN',	 'Lengua y Literatura',        'Language & Literature',     '0', 'len', ''),
               ('LAT',	 'Latín',                      'Latin',                     '0', 'lat', ''),
               ('MATE',	 'Matemáticas',                'Mathematics',               '0', 'mat', ''),
               ('MUS',	 'Música',                     'Music',                     '0', 'mus', ''),
               ('ORIEN', 'Orientación',                'Guidance',                  '0', 'ori', ''),
               ('PCPI',  'P.C.P.I.',                   'P.C.P.I.',                  '2', 'pcp', ''),
               ('RELI',	 'Religión',                   'Religion',                  '0', 'rel', ''),
               ('TECNO', 'Tecnología',                 'Technology',                '0', 'tec', '');";
 if (!mysqli_query($con, $sql)) {
    die ('No se puede dar de alta los departamentos:' .
          mysqli_error($con));
 };
 echo "Se han dado de alta los departamento<br>";

?>
</body>
</html>


  <?php
/*$movimientos = array
  (
  array("2019-01-15", "10:15", "Apertura de cuenta", 1200),
  array("2019-01-17", "10:05", "Ingreso en efectivo", 100),
  array("2019-01-18", "09:15", "Reintegro en ventanilla", 800),
  array("2019-01-14", "08:35", "Recibo Movistar", 60)
  );
$myJSON = json_encode($movimientos);
echo $myJSON;
*/    

$archivo   = "../banco.conf";
$contenido = parse_ini_file($archivo, true);
$equipo    = $contenido["equipo"];
$bd        = $contenido["bd"];
$usuario   = $contenido["usuario"];
$clave     = $contenido["clave"];

header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$con = mysqli_connect($equipo, $usuario, $clave) or die("No se pudo establecer la conexión con el servidor MySQL");
// Si no se conecta y no se especifica la instrucción die
// se suceden los estados: 1-0, 2-500, 4-500
// Si no se conecta pero se especifica la instrucción die
// se suceden los estados: 1-0, 2-200, 3-200 y 4-200 y se retorna el mensaje

$db = mysqli_select_db($con, $bd);
if (!$db) {
       die ('No se puede seleccionar la B.D. Banco:' . mysqli_error($con));
};

$sql = 'SELECT * FROM movimientos WHERE mo_ncu = "' . $obj->cuenta . '"';
$resul = mysqli_query ($con, $sql) or
         die ('Error en el acceso a la base de datos: ' . mysqli_error($con));

echo $resul;
/*
var_dump($_resul);


if (mysqli_fetch_array($resul)){
   $myJSON = json_encode(mysqli_fetch_array($resul);
   echo $myJSON;

*/

/*


      while ($fila = mysqli_fetch_assoc($resul)) {
          echo '<tr>';
          echo '<td>' . $fila['mo_fec'] . '</td><td>' . $fila['mo_des'] . '</td><td align="right">' . $fila['mo_imp'] . '</td>';
          echo '</tr>';
      }

      echo '</table>';
    } else {
      echo '<script>alert("RESULTADO: Sin movimientos");</script>';
    }
*/
/*
    // Libera la memoria del resultado
    mysql_free_result($resul);
    // Cierra la conexión con la base de datos
    mysql_close($con);
*/
?>

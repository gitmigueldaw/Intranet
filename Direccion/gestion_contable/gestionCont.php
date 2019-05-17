<div class="container-contable">
    <div class="location">
        <span>Dirección / Gestión Contable</span>
    </div>
    <div class="ges-cont">
        <div class="dir_ges_ante_table">   
            <div class="dir_ges_titulo">
                <h1>Movimientos y Gestión de Saldo</h1>
            </div>
            <table class="dir_ges_table">
                <tr>
                    <th class="dir_ges_principio">
                        <!--lista de seleccion de los departamentos-->
                        <form id="formularioContable" method="POST" class="dir_ges_form1">
                            <select name="departamentos" id="departamentos">
                                <option>---------------------</option>
                                <option value="AUTO">Automoción</option>
                                <option value="BIO">Biología y Geología</option>
                                <option value="CAMPE">Campeonatos Escolares</option>
                                <option value="DIBU">Dibujo</option>
                                <option value="ECO">Economía</option>
                                <option value="EFISI">Educación Física</option>
                                <option value="ELECA">Electricidad y Electrónica</option>
                                <option value="EXT">Actividades Extraesc.</option>
                                <option value="FILO">Filosofía</option>
                                <option value="FIQUI">Física y Química</option>
                                <option value="FOL">F.O.L.</option>
                                <option value="FRAN">Francés</option>
                                <option value="FRIO">Frío y Calor</option>
                                <option value="GEO">Geografía e Historia</option>
                                <option value="INFOR">Informática</option>
                                <option value="ING">Inglés</option>
                                <option value="JESTU">Jefatura de Estudios</option>
                                <option value="LAT">Latín</option>
                                <option value="LEN">Lengua y Literatura</option>
                                <option value="MATE">Matemáticas</option>
                                <option value="MUS">Música</option>
                                <option value="ORIEN">Orientación</option>
                                <option value="PCPI">P.C.P.I.</option>
                                <option value="RELI">Religión</option>
                                <option value="TECNO">Tecnología</option>
                            </select>
                        </form>
                    </th>
                    <th class="dir_ges_medio">Fecha</th>
                    <th class="dir_ges_medio">Concepto</th>
                    <th class="dir_ges_medio">Nº Movimiento</th>
                    <th class="dir_ges_fin">Importe</th>
                </tr>
                <?php
                //clase de conexion
                include_once './Comun/conexion.php';
                //instancia
                $clasConexion = new Conexion();
                //cojo la conexion
                $con = $clasConexion->getCon();

                if (isset($_POST['mo_concepto'])) {
                    //query del insert movimiento
                    $stmt = $con->prepare("INSERT INTO `movimientos`(`mo_coddep`, "
                            . "`mo_fecha`, `mo_concep`, `mo_nummov`, `mo_import`) VALUES "
                            . "(?,?,?,?,?)");

                    //convierto fecha a string
                    $hoy = date("Y-m-d") . "";
                    //asigno parametro del formulario de mas abajo
                    $stmt->bind_param("sssii", $_POST['mo_dep'], $hoy, $_POST['mo_concepto'], $_POST['mo_nummov'], $_POST['mo_importe']);
                    $stmt->execute();
                    $rows = $stmt->affected_rows;

                    //compruebo si se ha completado
                    if ($rows < 0) {
                        echo '<span class="salida-error">ERROR</span>';
                    } else {
                        echo '<span class="salida-completa">COMPLETO</span>';
                    }
                    //cierro consulta
                    $stmt->close();
                }

                //compruebo que este en algun lado las iniciales del departamento
                if (isset($_POST['departamentos']) || isset($_POST['mo_dep']) || isset($_GET['departamento'])) {

                    //se las asigno a una variable
                    if (isset($_POST['departamentos'])) {
                        $siglasDpt = $_POST['departamentos'];
                    } else if (isset ($_GET['departamento'])) {
                        $siglasDpt = $_GET['departamento'];
                    } else {
                        $siglasDpt = $_POST['mo_dep'];
                    }

                    //selecciono el nombre del departamento
                    $stmt = $con->prepare("SELECT de_descri_es FROM departamentos WHERE de_codigo = ?");
                    $stmt->bind_param("s", $siglasDpt);
                    $stmt->execute();
                    $stmt->bind_result($descripcion); //nombre del departamento
                    $stmt->fetch();
                    //cierro consulta
                    $stmt->close();
                    ?>

                    <tr id="insert">
                        <td colspan="5" class="dir_ges_td_form">
                            <!--formulario para insertar un elemento-->
                            <form method="POST" class="dir_ges_form2" id="formularioContable2">
                                <!--Guardo siglas depart, no pude guardarlas en session o cookie por la cabecera-->
                                <input type="hidden" value="<?php echo $siglasDpt; ?>" name="mo_dep">
                                <div class="dir_ges_todo_divs">
                                    <div class="dir_ges_div-1">
                                        <input id="en" type="submit" value="Registrar">
                                    </div>
                                    <div class="dir_ges_div-2">
                                        <span><?php echo date("Y-m-d"); ?></span>
                                    </div>
                                    <div class="dir_ges_div-3">
                                        <input type="text" name="mo_concepto" placeholder="Concepto" required="required">
                                    </div>
                                    <div class="dir_ges_div-4">
                                        <input type="number" name="mo_nummov" placeholder="Nº Movimiento" min="-9999" max="9999" required="required">
                                    </div>
                                    <div class="dir_ges_div-5">
                                        <input type="number" name="mo_importe" placeholder="Importe" min="-9999" max="9999" required="required">
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                    <?php
                    //selecciono todos los registros de movimientos con ese id de departamento
                    $stmt = $con->prepare("SELECT mo_id, mo_fecha, mo_concep, mo_nummov,"
                            . "mo_import FROM movimientos WHERE mo_coddep = ?");
                    $stmt->bind_param("s", $siglasDpt);
                    $stmt->execute();
                    //asigno valores a variables
                    $stmt->bind_result($id, $fecha, $concepto, $numMov, $importe);

                    //iterracion para printearlas
                    while ($stmt->fetch()) {
                        echo '<tr>'
                        . '<td><img src="./Direccion/gestion_contable/img/iconoPapelera.png" alt="icono papelera">'
                                . '<a class="borrar" href=?dirges&id=' . $id . '>'. $descripcion . '</a></td>'
                        . '<td>' . $fecha . '</td>'
                        . '<td>' . $concepto . '</td>'
                        . '<td>' . $numMov . '</td>'
                        . '<td>' . $importe . '</td>'
                        . '</tr>';
                    }
                    //cierro consulta
                    $stmt->close();
                }

                if (isset($_GET['id'])) {
                    //compruebo el GET para borrar el registro
                    $stmt = $con->prepare("DELETE FROM movimientos WHERE mo_id = ?");
                    $stmt->bind_param("i", $_GET['id']);
                    $stmt->execute();
                    $rows = $stmt->affected_rows;

                    if ($rows > 0) {
                        ?>
                        <!--Si se borra recargo URI-->
                        <script>
                            //ya que no se puede usar un header o cookies
                            //reconstruyo la URI con el host + dirges+
                            //y le añado el GET de departamentos para que se recargue
                            //la lista sin necesidad de un reload
                            var trozos = window.location.href.split("&");
                            window.location = trozos[0] + "&" + trozos[2];
                            //location.reload();
                        </script>
                        <?php
                    } else {
//                        Si no mensaje de error
                        echo 'No se ha borrado';
                    }
                    //cierro consulta
                    $stmt->close();
                    //cierro conexion
                    $con->close();
                }
                ?>
            </table>
        </div>
        <script src="Direccion/gestion_contable/js/jsContabilidad.js"></script>
    </div>
</div>

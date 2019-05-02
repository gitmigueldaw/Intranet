<div class="container-contable">
    <div class="location">
        <span>Dirección / Gestión Contable</span>
        <span id="fecha"></span>
    </div>
    <div class="ges-cont">
        <div class="dir_ges_ante_table">   
            <div class="dir_ges_titulo">
                <h1>Movimientos y Gestión de Saldo</h1>
            </div>
            <table class="dir_ges_table">
                <tr>
                    <th class="dir_ges_principio">
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
                    <th class="dir_ges_fin">Importe</th>
                </tr>
                <?php
                $con = new mysqli('localhost', 'root', 'root', 'basedatos')
                        or die("No se ha podido conectar al servidor");
                
                if (isset($_POST['mo_concepto'])) {

                    $stmt3 = $con->prepare("INSERT INTO `movimientos`(`mo_coddep`, "
                            . "`mo_fecha`, `mo_concep`, `mo_import`) VALUES "
                            . "(?,?,?,?)");
                    //convierto fecha a string
                    $hoy = date("Y-m-d") . "";
                    $stmt3->bind_param("sssi", $_POST['mo_dep'], $hoy, $_POST['mo_concepto'], $_POST['mo_importe']);
                    $stmt3->execute();
                    $rows = $stmt3->affected_rows;

                    if ($rows < 0) {
                        echo '<span class="salida-error">ERROR</span>';
                    } else {
                        echo '<span class="salida-completa">COMPLETO</span>';
                    }
                    //cierro consulta
                    $stmt3->close();
                }

                if (isset($_POST['departamentos']) || isset($_POST['mo_dep'])) {

                    if (isset($_POST['departamentos'])) {
                        $siglasDpt = $_POST['departamentos'];
                    } else {
                        $siglasDpt = $_POST['mo_dep'];
                    }

                    $stmt2 = $con->prepare("SELECT de_descri_es FROM departamentos WHERE de_codigo = ?");
                    $stmt2->bind_param("s", $siglasDpt);
                    $stmt2->execute();
                    $stmt2->bind_result($descripcion); //nombre del departamento
                    $stmt2->fetch();
                    //cierro consulta
                    $stmt2->close();
                    ?>
                    <tr id="insert">
                        <td colspan="4" class="dir_ges_td_form">
                            <form method="POST" class="dir_ges_form2" id="formularioContable2">
                                <!--Guardo siglas depart, no pude guardarlas en session o cookie por la cabecera-->
                                <input type="hidden" value="<?php echo $siglasDpt; ?>" name="mo_dep">
                                <input id="en" type="submit" value="Registrar">
                                <span><?php echo date("Y-m-d"); ?></span>
                                <input type="text" name="mo_concepto" placeholder="Concepto" required="required">
                                <input type="number" name="mo_importe" placeholder="Importe" min="-9999" max="9999" required="required">
                            </form>
                        </td>
                    </tr>
                    <?php
                    $stmt = $con->prepare("SELECT mo_id, mo_fecha, mo_concep, "
                            . "mo_import FROM movimientos WHERE mo_coddep = ?");
                    $stmt->bind_param("s", $siglasDpt);
                    $stmt->execute();
                    //asigno valores a variables
                    $stmt->bind_result($id, $fecha, $concepto, $importe);

                    while ($stmt->fetch()) {
                        echo '<tr>'
                        . '<td><a class="borrar" href=?dirges&id=' . $id . '>' . $descripcion . '</a></td>'
                        . '<td>' . $fecha . '</td>'
                        . '<td>' . $concepto . '</td>'
                        . '<td>' . $importe . '</td>'
                        . '</tr>';
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

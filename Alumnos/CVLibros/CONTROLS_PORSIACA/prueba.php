<?php

include_once 'modelo/Modelo.php';
include_once 'funciones/funciones.php';

$pdo = PatronSingleton::getSingleton();
$pdo->UPDATE_anuncio('400', 'prueba', 'prueba', 'prueba', 'prueba', '44');
        
die();


include_once 'modelo/Modelo.php';
include_once 'controlador/funciones/funciones.php';

echo $hash = password_hash("Qwerty0", PASSWORD_DEFAULT, [15]);
die();

$pdo = PatronSingleton::getSingleton();

$vendedor = $pdo->SELECT_vendedor("miguel@gmail.com");

//var_dump($vendedor);
//var_dump($pdo->SELECT_vendedor("miguel@gmail.com", "Contra0"));

$hash = $vendedor['hash_pass'];
$pass = 'Contra0';

if (password_verify($pass, $hash)) {
    echo 'coincide';
} else {
     echo 'NO coincide';
}



//if ($_REQUEST['rango'] != 0) {
//$anuncios = $pdo->SELECT_anuncios_de_rango($_REQUEST['rango']);  // $_REQUEST['rango']
//echo '<pre>';
//print_r($anuncios);
//echo json_encode($anuncios);
//echo '</pre>';

die();
?>



<!--<table>
    <tr>
<?php foreach ($anuncios[0] as $colum => $valor) { ?>
    <?php if (strcmp($colum, 'isbn') == 0 || strcmp($colum, 'titulo') == 0 || strcmp($colum, 'estado') == 0 || strcmp($colum, 'precio') == 0 || strcmp($colum, 'foto') == 0) { ?>
                        <th><b><?php echo $colum; ?></b></th>
    <?php } ?>
<?php } ?>
    </tr>

<?php foreach ($anuncios as $fila) { ?>
            <tr>
    <?php foreach ($fila as $colum => $valor) { ?>
        <?php if (strcmp($colum, 'isbn') == 0 || strcmp($colum, 'titulo') == 0 || strcmp($colum, 'estado') == 0 || strcmp($colum, 'precio') == 0 || strcmp($colum, 'foto') == 0) { ?>
            <?php if (strcmp($colum, 'foto') == 0) { ?>
                                        <td>
                                            <a href="<?php echo 'fotos/' . $valor . '/' . $valor . '.jpg' ?>" target="_blank">
                                                <img src="<?php echo 'fotos/' . $valor . '/' . $valor . '_mini.jpg' ?>" alt="foto"/>
                                            </a>
                                        </td>
            <?php } else { ?>
                                        <td>  <?php echo $valor ?> </td>
            <?php } ?>
        <?php } ?>
    <?php } ?>
            </tr>
<?php } ?>
</table>-->


<?php
//} else {
//    echo "{'id' : 'no'}";
//}
?>

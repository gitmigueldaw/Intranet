
<h1>Bienvenido a la sección de venta de libros.</h1>

<div>
    <h4>Quiero vender</h4>
    <div>
        <a href="controlador/c_login_registro/controlador_login_reg.php?tipo=login">Inicia sesión</a> <!-- target="_blank" -->
    </div> 
    
    <div>
        <a href="controlador/c_login_registro/controlador_login_reg.php?tipo=registro">Regístrate</a> <!-- target="_blank" -->
    </div> 
</div>


<?php
if (count($rangos) > 0) {
    ?>            

    <select id="elSelect">
        <option value="0">Selecciona nivel educativo</option>

    <?php foreach ($rangos as $cadaFila) { ?>
            <option value="<?php echo $cadaFila['id'] ?>"> - <?php echo $cadaFila['rango'] ?></option>
        <?php } ?>
    </select> 

<?php } else { ?>

    <select>
        <option value="0">No hay libros a la venta</option>
    </select> 

<?php } ?>

<div id="resp"></div>

<div id="foto"></div>




<div class="cuerpo_alu_com">

    <h1>Bienvenido a la sección de venta de libros</h1>

    <div style="display: flex;">      

        <div class="anuncios_alu_com">
            <h3><span>Consulta los libros a la venta</span></h3>

            <?php
            if (count($rangos) > 0) {
                ?>         

                <!--<label for="elSelect_alu_com">- Selecciona categoría:</label>-->

                <select id="elSelect_alu_com">
                    <option value="0">Selecciona categoría</option>

                    <?php foreach ($rangos as $cadaFila) { ?>
                        <option value="<?php echo $cadaFila['ra_id'] ?>"> - <?php echo $cadaFila['ra_rango'] ?></option>
                    <?php } ?>
                </select> 

            <?php } else { ?>

                <select id="elSelect_alu_com">
                    <option value="0">No hay libros a la venta</option>
                </select> 

            <?php } ?>
        </div>

        <div class="quiero_vender_alu_com">
            <!--<h4>Acceso vendedores</h4>-->
            <a class="hvr-grow-shadow boton_alu_com" href="?alu_com&logearse">Inicia sesión</a> <!-- target="_blank" -->
            <a class="hvr-grow-shadow boton_alu_com" href="?alu_com&registrarse">Regístrate</a> <!-- target="_blank" -->
        </div>
    </div>

    <div style="display: flex; margin: 2.5vw 0 1.2vw 0;">     
        <div id="resp_alu_com"></div>
        <div id="foto_alu_com"></div>
    </div>
</div>
<!------------------------------------------------------------------------------------->

<!-- jquery online -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->

<!-- Cargar el local si el CDN (online) no responde --> 
<script>
    if (window.jQuery === undefined)
        document.write('<script src="js/jquery-3.3.1.min.js"><\/script>');
</script>  

<!-- Mi javascript -->
<script src="Alumnos/CVLibros/_javascript/js_index_anonimo.js" type="text/javascript"></script> 

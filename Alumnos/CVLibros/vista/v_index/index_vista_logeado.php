<div class="cuerpo_alu_com">

    <h1><?php echo $_SESSION['logeado_alu_com']['ve_nombre']; ?>, bienvenido a la sección de venta de libros</h1>

    <div style="display: flex;">  

        <div class="verCrearAnuncios_alu_com">          
                <button class="hvr-grow-shadow boton3_alu_com"  id="btnVerAnunciosLogeado_alu_com">Ver mis anuncios</button>
                <a class="hvr-grow-shadow boton3_alu_com"  href="?alu_com&nuevoanuncio">Anuncio nuevo</a>
        </div>

        <div class="anuncios2_alu_com">
            <h3><span>Consulta los libros a la venta</span></h3>

            <?php
            if (count($rangos) > 0) {
                ?>          

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

        <div class="cierreSesion_alu_com">
            <a class="hvr-grow-shadow boton_cerrarSesion_alu_com" href="?alu_com&cerrarsesion">Cerrar sesion</a>
        </div>
    </div>


    <div style="display: flex; margin: 2.5vw 0 1.2vw 0;">    
        <div id="resp_alu_com"></div>
        <div id="foto_alu_com"></div>
    </div>

</div>
<!-- ____________________________________________________________________________________ -->

<!-- jquery online -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->

<!-- Cargar el local si el CDN (online) no responde --> 
<script>
    if (window.jQuery === undefined)
        document.write('<script src="js/jquery-3.3.1.min.js"><\/script>');
</script>   

<!-- PROBLEMA: Necesito en javascript usar una variable de PHP, pero desde el fichero .js
no se puede coger, sin embargo desde aquí si, por lo que guardo el dato en javascript 
aquí y lo uso en js_index_logeado.js añadido debajo
-->
<script>
    var emailLogeado = "<?php echo $_SESSION['logeado_alu_com']['email'] ?>";
</script>

<!-- Mi javascript -->
<script src="Alumnos/CVLibros/_javascript/js_index_logeado.js" type="text/javascript"></script> 
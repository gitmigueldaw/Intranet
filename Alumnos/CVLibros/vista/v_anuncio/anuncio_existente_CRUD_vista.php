<div class="cuerpo_alu_com">

    <h1>Tu anuncio detallado</h1>

    <div class="cuerpo_anuncio_alu_com">       

        <div class="izqda_anuncio_alu_com">
            <h3>INFORMACIÓN SOBRE EL LIBRO</h3>
            <div>
                <span class="propiedad_libro_alu_com"><label for="cajaISBN">· ISBN:</label></span>
                <input type="text" id="cajaISBN" maxlength="45" value="<?php echo $anuncio['an_isbn']; ?>" readonly="readonly">
            </div>

            <div>
                <span class="propiedad_libro_alu_com"><label for="cajaTITULO">· Titulo:</label></span>
                <input type="text" id="cajaTITULO" maxlength="100" value="<?php echo $anuncio['an_titulo']; ?>" readonly="readonly">
            </div>

            <div>
                <span class="propiedad_libro_alu_com"><label for="cajaEDITORIAL">· Editorial:</label></span>
                <input type="text" id="cajaEDITORIAL" maxlength="45" value="<?php echo $anuncio['an_edito']; ?>" readonly="readonly">
            </div>

            <div>
                <span class="propiedad_libro_alu_com"><label for="cajaPRECIO">· Precio:</label></span>
                <input type="number" step="0.01" class="cajaPrecio_alu_com" id="cajaPRECIO" value="<?php echo $anuncio['an_precio']; ?>" readonly="readonly"> €.
            </div>

            <div>
                <span class="propiedad_libro_alu_com"><label for="cajaESTADO">· Estado:</label></span><br>
                <textarea class="caja_estado_alu_com" name="cajaESTADO" id="cajaESTADO" maxlength="499" value="" placeholder="" required="required" readonly="readonly"><?php echo quita_br_a_saltos_de_linea($anuncio['an_estado']); ?></textarea>
                <!--<input type="text" id="cajaESTADO" maxlength="300" value="<?php echo $anuncio['an_estado']; ?>" readonly="readonly">-->
            </div>

            <div>
                <span class="propiedad_libro_alu_com">· FECHA DEL ANUNCIO:</span>
                <span><?php echo $fechaFormateada; ?></span>
            </div>

            <?php if ($anuncio['an_foto'] != null) { ?>
                <span class="propiedad_libro_alu_com">· IMAGEN:</span> (click para tamaño completo)

                <p>
                    <a href="<?php echo $dirFoto; ?>" target="_blank">
                        <img class="miniatura_detalle_alu_com" src="<?php echo $dirMiniatura; ?>" alt="foto">
                    </a>
                </p>
            <?php } else { ?>
                <span class="propiedad_libro_alu_com">· IMAGEN: </span>
                <p style="margin-left: 2vw;">Sin imagen</p>

            <?php } ?>

            <div style="display: flex;">
                <div id="cambiaBoton">
                    <button class="hvr-grow-shadow boton_edit_alu_com"  id="btnEditarAnuncio">Editar anuncio</button>
                </div>

                <button class="hvr-grow-shadow boton_borra_alu_com" id="btnCerrarAnuncio">Borrar anuncio</button>
            </div>
        </div>


        <div class="dcha_anuncio_alu_com">
            <h3>DATOS DE CONTACTO</h3>
            <div>
                <span class="propiedad_vendedor_alu_com">· Nombre:</span>
                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <span><?php echo $anuncio['ve_nombre']; ?></span>
            </div>

            <div>
                <span class="propiedad_vendedor_alu_com">· Teléfono:</span>
                <?php if ($anuncio['ve_telefo'] != null) { ?>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <span><?php echo $anuncio['ve_telefo']; ?></span>

                <?php } else { ?>
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <span class="propiedad_vendedor_alu_com">· No registrado</span>
                <?php } ?>
            </div>

            <div>
                <span class="propiedad_vendedor_alu_com">· Correo electrónico:</span>
                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <span><?php echo $anuncio['an_email']; ?></span>
            </div>

            <div>
                <a class="hvr-grow-shadow boton_inicio_alu_com" href="?alu_com">Volver al inicio</a> 
            </div>
        </div>
    </div>
</div>

<!-- _______________________________________________________________ -->

<!-- jquery online -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->

<!-- Cargar el local si el CDN (online) no responde --> 
<script>
    if (window.jQuery === undefined)
        document.write('<script src="js/jquery-3.3.1.min.js"><\/script>');
</script>  

<!-- PROBLEMA: Necesito en javascript usar una variable de PHP, pero desde el fichero .js
no se puede, sin embargo desde aquí si, por lo que guardo el dato en javascript aquí y lo uso
en js_anuncio_CRUD.js añadido debajo
-->
<script>
    var idAnuncio = "<?php echo $id; ?>";
</script>

<!-- Alert y confirm personalizados -->
<script src="Alumnos/CVLibros/_javascript/jquery-confirm.min.js" type="text/javascript"></script> 

<!-- Necesario para desactivar la necesidad de bootstrap con jquery-confirm -->
<script>
    jconfirm.defaults = {
        useBootstrap: false
    };
</script> 

<!-- Mi javascript -->
<script src="Alumnos/CVLibros/_javascript/ajuste_estilo_base.js" type="text/javascript"></script> 
<script src="Alumnos/CVLibros/_javascript/js_anuncio_CRUD.js" type="text/javascript"></script> 
<div class="cuerpo_alu_com">

    <h1>Anuncio detallado</h1>

    <div class="cuerpo_anuncio_alu_com">

        <div class="izqda_anuncio_alu_com">
            <h3>INFORMACIÓN SOBRE EL LIBRO</h3>
            <div>
                <span class="propiedad_libro_alu_com">· ISBN:</span>
                <span><?php echo $anuncio['an_isbn']; ?> </span>
            </div>

            <div>
                <span class="propiedad_libro_alu_com">· TÍTULO:</span>
                <span><?php echo $anuncio['an_titulo']; ?></span>
            </div>

            <div>
                <span class="propiedad_libro_alu_com">· EDITORIAL:</span>
                <span><?php echo $anuncio['an_edito']; ?></span>
            </div>

            <div>
                <span class="propiedad_libro_alu_com">· ESTADO:</span>
                <span><?php echo $anuncio['an_estado']; ?></span>
            </div>

            <div>
                <span class="propiedad_libro_alu_com">· PRECIO (€):</span>
                <span><?php echo $anuncio['an_precio']; ?></span>
            </div>

            <div>
                <span class="propiedad_libro_alu_com">· FECHA DEL ANUNCIO:</span>
                <span><?php echo $fechaFormateada; ?></p>
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
                    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <span>No registrado</span>
                <?php } ?>
            </div>

            <div>
                <span class="propiedad_vendedor_alu_com">· Correo electrónico:</span>
                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <span><?php echo $anuncio['an_email']; ?></span>
            </div>
        </div>
    </div>

    <div>
        <a class="hvr-grow-shadow boton_inicio_alu_com" href="?alu_com">Volver al inicio</a>
    </div>
</div>
<!--____________________________________________________________________-->

<!-- jquery online -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->

<!-- Cargar el local si el CDN online(online) no responde --> 
<script>
    if (window.jQuery === undefined)
        document.write('<script src="js/jquery-3.3.1.min.js"><\/script>');
</script>     

<!-- Mi javascript -->
<script src="Alumnos/CVLibros/_javascript/ajuste_estilo_base.js" type="text/javascript"></script> 
<!--<script src="Alumnos/CVLibros/_javascript/js_anuncio.js" type="text/javascript"></script>--> 

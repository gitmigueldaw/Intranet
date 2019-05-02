<div class="cuerpo_alu_com">

    <h1>Detalla las características del libro</h1>

    <div class="cuerpo_anuncio2_alu_com">    

        <form class="centro_anuncio_nuevo_alu_com" action="<?php echo htmlspecialchars("Alumnos/CVLibros/crear_anuncio_nuevo.php"); ?>" 
              enctype="multipart/form-data" method="POST"> <!-- onSubmit="return validarForm(this)" -->

            <div>
                <label for="elSelect_alu_com">- Categoría*:</label>&nbsp;&nbsp;&nbsp;
                <select name="categoria" class="select_nuevo_anuncio_alu_com" id="elSelect_alu_com">
                    <?php foreach ($rangos as $cadaFila) { ?>
                        <option value="<?php echo $cadaFila['id'] ?>"> - <?php echo $cadaFila['rango'] ?></option>
                    <?php } ?>
                </select> 
                <span style="font-weight: normal; float: right;"><i>Los campos con asterisco son obligatorios</i></span>
            </div>

            <div>
                <label for="cajaISBN">- ISBN:</label>
                <input type="text" name="cajaISBN" id="cajaISBN" value="" maxlength="45">
            </div>

            <div>
                <label for="cajaTITULO">- Titulo*:</label>
                <input class="caja_titulo_alu_com" type="text" name="cajaTITULO" id="cajaTITULO" value="" maxlength="100" required="required">
            </div>

            <div>
                <label for="cajaEDITORIAL">- Editorial*:</label>
                <input class="caja_editorial_alu_com" type="text" name="cajaEDITORIAL" id="cajaEDITORIAL" maxlength="45" value="" required="required">
            </div>

            <div>
                <label for="cajaPRECIO">- Precio (€)*:</label>
                <input class="caja_precio_alu_com" type="number" step="0.01" name="cajaPRECIO" id="cajaPRECIO" value="0" required="required">
            </div>

            <div>
                <label for="cajaESTADO">- Estado*:</label>
                <textarea class="caja_estado_alu_com" name="cajaESTADO" id="cajaESTADO" maxlength="499" value="" required="required"></textarea>
                <!--<input class="caja_estado_alu_com" type="text" name="cajaESTADO" id="cajaESTADO" maxlength="300" value="" required="required">-->
            </div>

            <div class="subida_foto_alu_com">
                <span>- Sube una imagen:</span>
                <span style="font-size: 1.1vw; font-weight: normal !important;">(Formatos soportados: JPG, JPEG, PNG, BMP y GIF. Tamaño máximo: 2MB)</span><br>
                <input style="border: none; margin-left: 2vw;" type="file" name="archivo_a_subir" id="inputFile">
            </div>

            <div>
                <span><?php echo $_SESSION['MENS_FOTO_alu_com']; ?></span>
            </div>

            <br>
            <!--DATOS OCULTOS-->
            <!--<input type="hidden" name="archivo_a_subir" id="inputFile">-->

            <div class="parte_botones_alu_com">
                <input class="hvr-grow-shadow boton_confirmAnuncio_alu_com" type="submit" value="Crear anuncio" name="btnSubmitAnuncioNuevo" id="btnRegistrarse"/>
                <a class="hvr-grow-shadow boton_inicio2_alu_com" href="?alu_com">Volver al inicio</a> 
            </div>
        </form>

    </div>
</div>

<!-- _______________________________________________________________ -->


<!-- Ventana modal -->
<div id="myModal_alu_com" class="modal_alu_com">

    <div class="modal-content_alu_com">
        <div class="modal-header_alu_com">
            <span class="close_alu_com">&times;</span>  <!-- Times = X -->
            <h2>&nbsp; ■ &nbsp; Ten en cuenta:</h2>
        </div>
        <div class="modal-body_alu_com">
            <p><b>-</b> El anuncio tendrá una validez de <b>4 meses</b>. Tras ese periodo será borrado
                <br>&nbsp;&nbsp;&nbsp;junto a su imagen asociada, si la tuviera.</p>
            <p><b>-</b> Puedes anunciar lotes de libros.</p>
            <p><b>-</b> Si no quieres poner un precio, fíjalo en <b>0</b>.</p>
            <p><b>-</b> Si vendes el libro, recuerda borrar el anuncio.</p>
            <p><b>-</b> No utilices palabras malsonantes u ofensivas.</p>
            <p><b>-</b> No subas una imagen inapropiada o ajena al libro en cuestión.</p>
        </div>
        <div class="modal-footer_alu_com">
            &nbsp;
            <!--<h3>Modal Footer</h3>-->
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

<!-- Mi javascript -->
<script src="Alumnos/CVLibros/_javascript/js_anuncio.js" type="text/javascript"></script> 

<!-- Ventana modal -->
<script src="Alumnos/CVLibros/_javascript/modal.js" type="text/javascript"></script> 

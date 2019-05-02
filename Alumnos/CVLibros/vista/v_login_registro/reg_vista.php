<div class="cuerpo_alu_com">

    <h1>Regístrate para vender.</h1>

    <div class="cuerpo_registro_alu_com">   
        <!-- 
        Es un formulario, porque para que compruebe automáticamente los campos de tipo
        email, o los requeridos, debe ser un form Y TENER BOTÓN SUBMIT (un botón genérico
        que lanfe formulario.submit() no realiza esas comprobaciones.)
        -->

        <!-- El form tiene en la equiqueta el onsubmit, porque con escuchador no he conseguido
        hacer funcionar comprobaciones del párrafo anterior. --> 
        <form class="centro_registro_alu_com" action="<?php echo htmlspecialchars('Alumnos/CVLibros/proceso_registro.php'); ?>" method="POST" onSubmit="return validarForm(this)">  <!-- onSubmit="return validarForm(this)" -->
            <div class="asterisco">
                <i>Los campos con asterisco son obligatorios</i>
            </div>

            <div>
                <label for="cajaEmail">- E-mail*:</label>
                <span style="font-weight: normal; float: right;"></span>
                <input type="email" name="email" maxlength="60" value="" id="cajaEmail_alu_con" required="required"/> 
                <span id="mens_email_alu_con"></span>
            </div>


            <div>
                <label for="cajaPass">- Contraseña*:</label>
                <input type="password" name="pass" value="" id="cajaPass_alu_con" maxlength="20" required="required"/> 
                <span id="mens_pass_alu_con"></span>
            </div> 

            <div>
                <label for="cajaRepitePass">- Repite la contraseña*: </label>
                <input type="password" name="r_pass" value="" id="cajaRepitePass_alu_con" required="required" disabled="disabled"/> 
                <span id="mens_r_pass_alu_con"></span>
            </div> 


            <div>
                <label for="cajaNombre">- Nombre de contacto*: </label>
                <input type="text" name="nombre" maxlength="45" value="" id="cajaNombre_alu_con" required="required"/> 
                <span id="mens_nombre_alu_con"></span>
            </div>

            <div>
                <label for="cajaTelefono">- Teléfono móvil:</label>
                <input type="text" name="telefono" maxlength="11" value="" id="cajaTelefono_alu_con" maxlength="9"/>  <!--  required="required" -->
                <span id="mens_telefono_alu_con"></span>
            </div>

            <br>

            <div class="parte_botones_alu_com">
                <input class="hvr-grow-shadow boton_registro_alu_com" type="submit" value="Registrarse" name="btnSubmitReg" id="btnRegistrarse_alu_con"/>
                <a class="hvr-grow-shadow boton_inicio_reg_alu_com" href="?alu_com">Volver al index</a>
            </div>

        </form>
        <!--<div id="mensaje_alu_con"></div>div-->
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
            <p><b>-</b> Utiliza un correo electrónico real.</p>
            <p><b>-</b> Guarda la contraseña elegida. No se podrá recuperar.</p>
            <p><b>-</b> El teléfono móvil es opcional. Introdúcelo si deseas que el interesado pueda
                <br>&nbsp;&nbsp;&nbsp;ponerse en contacto contigo por esa vía (por ejemplo: WhatsApp o Telegram).</p>
        </div>
        <div class="modal-footer_alu_com">
            &nbsp;
            <!--<h3>Modal Footer</h3>-->
        </div>
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
<script src="Alumnos/CVLibros/_javascript/js_registro.js" type="text/javascript"></script> 

<!-- Ventana modal -->
<script src="Alumnos/CVLibros/_javascript/modal.js" type="text/javascript"></script> 
<div class="cuerpo_alu_com">

    <h1>Inicia sesión con tu cuenta de vendedor.</h1>

    <div class="cuerpo_login_alu_com">   

        <form class="centro_login_alu_com" action="<?php echo htmlspecialchars('Alumnos/CVLibros/proceso_login.php'); ?>" method="POST" onSubmit="return validaForm(this)"> <!-- echo $_SERVER["PHP_SELF"]; -->
            <div>
                <label for="cajaEmail_alu_con">- E-Mail: </label>
                <input type="email" name="email" maxlength="60" value="<?php echo $_SESSION['datos_login_alu_com']['email']; ?>" id="cajaEmail_alu_con" required="required" placeholder="e-mail"/> 
                <span id="mensLoginMail_alu_com"><?php echo $_SESSION['errores_login_alu_com']['errEmail']; ?></span>
            </div>

            <div>
                <label for="cajaPass_alu_com" id="labelPass_alu_com">- Contraseña: </label>
                <input type="password" name="pass" value="<?php echo $_SESSION['datos_login_alu_com']['pass']; ?>" id="cajaPass_alu_com" required="required" placeholder="contraseña"/> 
                <span id="mensLoginPass_alu_com"><?php echo $_SESSION['errores_login_alu_com']['errPass']; ?></span>
            </div> 

            <br>

            <div class="parte_botones_alu_com">
                <input class="hvr-grow-shadow boton_log_alu_com" type="submit" value="Acceder" id="btnLogin_alu_com" name="btnSubmitLog"/>
                <a class="hvr-grow-shadow boton_inicio_log_alu_com" href="?alu_com">Volver al inicio</a>
            </div>

        </form>

        <div id="mensResultado_alu_com"></div>



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
<!--<script src="Alumnos/CVLibros/_javascript/js_login.js" type="text/javascript"></script>--> 



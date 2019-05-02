<h1>Inicia sesión con tu cuenta de vendedor.</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> <!-- echo $_SERVER["PHP_SELF"]; -->

    <div>
        <label for="cajaEMAIL">- Nombre: </label>
        <input type="text" name="nombre" value="<?php echo $_SESSION['datos']['nombre']; ?>" id="cajaNombre" required="required"/> 
        <?php echo $_SESSION['errores']['errNombre']; ?>
    </div>

    <div>
        <label for="cajaPass">- Contraseña: </label>
        <input type="password" name="pass" value="<?php echo $_SESSION['datos']['pass']; ?>" id="cajaPass" required="required"/> 
        <?php echo $_SESSION['errores']['errPass']; ?>
    </div> <br>

    <input type="submit" value="Acceder" name="btnSubmitLog" />

    <br><br>_________________________________________________________<br><br> 

    <div>
        <label for="cajaDNI">- DNI: </label>
        <input type="text" name="dni" value="<?php echo $_SESSION['datos']['dni']; ?>" id="cajaDNI" maxlength="9"/> 
        <?php echo $_SESSION['errores']['errDNI']; ?>
    </div>

    <div>
        <label for="cajaEmail">- Email: </label>
        <input type="text" name="email" value="<?php echo $_SESSION['datos']['email']; ?>" id="cajaEmail"/> 
        <?php echo $_SESSION['errores']['errEmail']; ?>
    </div>

    <div>
        - Estado civil:
        <div>
            <div>
                <label for="radioSoltero">Soltero: </label>
                <input type="radio" name="eCivil" value="soltero" id="radioSoltero" checked="checked" />
            </div>
            <div>
                <label for="radioCasado">Casado: </label>
                <input type="radio" name="eCivil" value="casado" id="radioCasado"/>
            </div>
            <div>
                <label for="radioDivorciado">Divorciado: </label>
                <input type="radio" name="eCivil" value="divorciado" id="radioDivorciado"/>
            </div>
            <div>
                <label for="radioViudo">Viudo: </label>
                <input type="radio" name="eCivil" value="viudo" id="radioViudo"/>
            </div>
        </div>
    </div>

    <div>
        <label for="cajaFecha">- Fecha de nacimiento: </label>
        <input type="date" name="fecha" value="<?php echo $_SESSION['datos']['fecha']; ?>" id="cajaFecha"/>
        <?php echo $_SESSION['errores']['errFecha']; ?>
    </div>

    <div>
        <label for="cajaPostal">- Código postal: </label>
        <input type="number" name="postal" value="<?php echo $_SESSION['datos']['codPostal']; ?>" id="cajaPostal" maxlength="5" />
        <?php echo $_SESSION['errores']['errCP']; ?>
    </div>

    <br><br>________________________________________________________<br><br>    

    <div>
        <label for="cajaCaptcha">- Captcha: </label>
        <input type="text" name="captcha" value="" id="cajaCaptcha"/>
        <?php echo $_SESSION['errores']['errCaptcha']; ?>
    </div>
    <br>

    <img src="controladores/captcha/captcha.php" alt="captcha">
    <br>

    _________________________________________________________<br><br> 

    <input type="submit" value="Registrarse" name="btnSubmitReg" />

    <!-- El mensaje de registro OK -->
    <?php echo $_SESSION['datos']['msgRegistro']; ?>    

</form>






<h1>Regístrate para vender.</h1>

<!-- 
Es un formulario, porque para que compruebe automáticamente los campos de tipo
email, o los requeridos, debe ser un form Y TENER BOTÓN SUBMIT (un botón genérico
que lanfe formulario.submit() no realiza esas comprobaciones.)
-->

<!-- El form tiene en la equiqueta el onsubmit, porque con escuchador no he conseguido
hacer funcionar comprobaciones del párrafo anterior. --> 
<form action="<?php echo htmlspecialchars('proceso_registro.php'); ?>" method="POST" onSubmit="return validarForm(this)">  <!-- onSubmit="return validarForm(this)" -->

    <div>
        <label for="cajaEmail">- E-mail*: </label>
        <input type="email" name="email" value="" id="cajaEmail" required="required"/> 
        <span id="mens_email"></span>
    </div><br>

    <div>
        <label for="cajaPass">- Contraseña*: </label>
        <input type="password" name="pass" value="" id="cajaPass" maxlength="20" required="required"/> 
        <span id="mens_pass"></span>
    </div> 

    <div>
        <label for="cajaRepitePass">- Repite la contraseña*: </label>
        <input type="password" name="r_pass" value="" id="cajaRepitePass" required="required" disabled="disabled"/> 
        <span id="mens_r_pass"></span>
    </div> 

    ___________________________________________________________________

    <div>
        <label for="cajaNombre">- Nombre de contacto*: </label>
        <input type="text" name="nombre" value="" id="cajaNombre" required="required"/> 
        <span id="mens_nombre"></span>
    </div>

    <div>
        <label for="cajaTelefono">- Teléfono móvil: </label>
        <input type="text" name="telefono" value="" id="cajaTelefono" maxlength="9"/>  <!--  required="required" -->
        <span id="mens_telefono"></span>
    </div>


    <!--    <br><br>________________________________________________________<br><br>    
    
        <div>
            <label for="cajaCaptcha">- Captcha: </label>
            <input type="text" name="captcha" value="" id="cajaCaptcha"/>
            <span id="mens_captcha"></span>
        </div>
    
        <img src="controladores/captcha/captcha.php" alt="el_captcha">-->

    _________________________________________________________<br><br> 

    <input type="submit" value="Registrarse" name="btnSubmitReg" id="btnRegistrarse"/>

</form>

<div id="mensaje"></div>


<script>
    var email;
    var mensaje_email;
    var pass;
    var mensaje_pass;
    var r_pass;
    var mensaje_r_pass;
    var labelRepite;
    var nombre;
    var mensaje_nombre;
    var telefono;
    var mensaje_telefono;
    var captcha;
    var mensaje_captcha;
    var botonRegistro;
    var mensaje_registro;
    var accion;

    email = document.getElementById("cajaEmail");
    mensaje_email = document.getElementById("mens_email");
    pass = document.getElementById("cajaPass");
    mensaje_pass = document.getElementById("mens_pass");
    r_pass = document.getElementById("cajaRepitePass");
    mensaje_r_pass = document.getElementById("mens_r_pass");
    nombre = document.getElementById("cajaNombre");
    mensaje_nombre = document.getElementById("mens_nombre");
    telefono = document.getElementById("cajaTelefono");
    mensaje_telefono = document.getElementById("mens_telefono");
    captcha = document.getElementById("cajaCaptcha");
    mensaje_captcha = document.getElementById("mens_captcha");
    mensaje_registro = document.getElementById("mensaje");

    labelRepite = document.getElementsByTagName("label")[2];
    botonRegistro = document.getElementById("btnRegistrarse");

//    document.forms[0].addEventListener("submit", validarForm());
//    botonRegistro.addEventListener("click", );

    labelRepite.style.color = "gray";

    email.addEventListener("change", test_usuario_registrado);
    pass.addEventListener("input", validarPass);
    r_pass.addEventListener("input", validarPassNoRepe);
    telefono.addEventListener("input", validarTelefono);

    //--------------------------------------------------------------------------

    function validarPass(evento) {
        var correcto = true;

        // Deshabilitar y poner gris el label y el input de repetir contraseña
        r_pass.disabled = true;
        labelRepite.style.color = "gray";

        mensaje_pass.innerHTML = "";

        if (pass.value.length > 0) {
            mensaje_pass.innerHTML = "Debe tener mínimo 5 caracteres, al menos una mayúscula, una minúscula y un número.";
            // Que tenga como mínimo una mayúscula, una minúsculay y un número, en cualquier posición.
            // Y como mínimo, 5 caracteres y max 20.
            if (!/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{5,20}/.test(pass.value)) {
                correcto = false;
                r_pass.value = "";
                mensaje_r_pass.innerHTML = "";

            } else {
                // Quitar mensaje y habilitar campo de repetir contraseña
                mensaje_pass.innerHTML = "Correcto";
                r_pass.disabled = false;
                labelRepite.style.color = "black";
            }
        }

        return correcto;
    }

    function validarPassNoRepe(evento) {
        var correcto = false;
        mensaje_r_pass.innerHTML = "";

        // Solo mostrar el mensaje y comprobar si coinciden al escribir tantos caracteres
        // como letras tiene el password
        if (r_pass.value.length > 0) { // >= pass.value.length
            if (pass.value != r_pass.value) {
                mensaje_r_pass.innerHTML = "Debe coincidir";
            } else {
                mensaje_r_pass.innerHTML = "Coinciden";
                correcto = true;
            }
        }

        return correcto;
    }

    function validarNombre() {
        // Para que no permita espacios en blanco como texto:
        var correcto = true;
        mensaje_nombre.innerHTML = ""

        // Si está en blanco con espacios (se los traga el required)
        if (/^[\s]{1,}$/.test(nombre.value)) {
            mensaje_nombre.innerHTML = "Debe rellenar este campo";
            correcto = false;
        }
        return correcto;
    }

    /* El teléfiono no es obligatorio. Se comprueba que no tenga espacios */
    function validarTelefono() {
        var correcto = true;
        mensaje_telefono.innerHTML = ""

        if (telefono.value.length > 0) {
            // Si se introducen solo espacios o se introduce caracteres no numéricos 
            // (el límite de 9 caracteres está en la etiqueta HTML)
            // o si se introducen menos de 6 números
            if (/[\s]{1,}/.test(telefono.value) || isNaN(telefono.value) || telefono.value.length < 9) {
                mensaje_telefono.innerHTML = "El teléfono es incorrecto."
                correcto = false;
            }
        }


        return correcto;
    }



    function validarForm(formulario) {
        var ok = false;

        if (validarPass() && validarPassNoRepe() && validarNombre() && validarTelefono() && disponible) {
            ok = true;
        }

        return ok;
    }


    /* NOTA: Primero se ejecuta el return y luego el success, por lo que el estado
     * resultante de lo que queremos devolver en la función (disponible) cambia después de retornarla.
     * La variable tendrá que estar en una variable global y cambiarla dependiendo del
     * resultado de la respuesta recibida */
    var disponible = false;
    
    function test_usuario_registrado() {     
        mensaje_email.innerHTML = "";

        if (email.value.length > 0) {
            $.ajax({
                url: 'proceso_registro.php', // la URL para la petición
                data: {correo: email.value}, // la información a enviar, con formato objeto de js                    
                type: 'POST', // especifica si será una petición POST o GET
                // timeout: 5000, // segundos de espera antes de dar como fallida la recepción

                success: function (respuesta, status, xhr) {
                    if (respuesta == "ocupado") {
                        mensaje_email.innerHTML = "El correo <b>" + email.value + "</b> ya existe";
                        disponible = false;

                        // Borrar mensaje a los 3 segundos
//                    setTimeout(function () {
//                        mensaje_email.innerHTML = "";
//                    }, 2000);

//                     Si no tiene un @, mensaje en blanco. Para que no aparezca el "Disponible"
                    } else if (!/@{1}/.test(email.value)) {
                        mensaje_email.innerHTML = "";
                        disponible = false;

                    } else {
                        mensaje_email.innerHTML = "Disponible";
                        disponible = true;
//                $("#estadoCuenta").html("");
//                elemento.form.elements["txtCuenta"].style.background = "#ccffcc";  // verde
//
//                // EXTRAER EL SALDO DE LA RESPUESTA A UNA VARIABLE, para la comparación al sacar dinero
//                var hasta = respuesta.indexOf("<");  // primer < del string (del '<table>').
//                saldoCuenta = parseInt(respuesta.substring(0, hasta - 1).trim());
//
//                var tablas = respuesta.substr(hasta); // Extraer desde el primer '<' al final
//
//                $("#destino").html(tablas);  // Las tablas
//
//                // Deshabilitar la caja de la cuenta, para que no se modifique ya que en sesión ya está
//                // guardada la cuenta consultada anteriormente.
//                elemento.form.elements["txtCuenta"].disabled = true;
//                elemento.form.elements["botonTestCuenta"].disabled = true;
//
//                // Los dos radio
//                elemento.form.elements["operacion"][0].disabled = false;
//                elemento.form.elements["operacion"][1].disabled = false;
//
//                elemento.form.elements["txtIngreso"].disabled = false;
//                elemento.form.elements["txtComentario"].disabled = false;
//
//                elemento.form.elements["btnIngreso"].disabled = false;
//                elemento.form.elements["btnCancel"].disabled = false;
                    }
                },
                error: function (xhr, status) {
                    mensaje_email.innerHTML = "Respuesta no recibida.";
                    // document.getElementById("#estadoCuenta").innerHTML = "Datos no recibidos";
                },
                complete: function (xhr, status) {
                    // $("#destino").html("<h2>Operacion finalizada</h2>");
                }
            });
        }
        
//        alert(disponible);        
//        return disponible;
    }


    function registrarse(event) {
        document.forms[0].submit();


        var formulario_OK = false;

        // Mensajes para inputs vacíos
        if (/^[\s]{0,}$/.test(email.value)) {
            mensaje_email.innerHTML = "Debe introducir su e-mail.";
        }


        validarEmail();
        validarPass();
        validarTelefono();
        test_inputs_vacios();

//        if(validarEmail() && validarPass() && validarTelefono() && test_inputs_vacios()){
//            alert("ok");
//        }


        var formOK = true;
        // Antes de usar ajax, hay que comprobar 
        // 1. que los inputs tienen algo escrito
        // 2. que el password tiene el formato correcto
        // 3. que los inputs obligatorios (*) tienen datos

        var datos = new Object();


    }


//    FALTA IMPLEMENTAR QUE NO HAYA ESPACIOS:

//    function test_inputs_vacios() {
//        var formOK = true;
//
//        mensaje_registro.innerHTML = "";
//
//        var inputs = document.getElementsByTagName("input");
//
//        // Los 4 primeros inputs son obligatorios, el 5º es el movil que no lo es.
//        for (var i = 0; i < 4; i++) {
//            // true si no hay caracteres, aunque haya espacios
//            if (/^[\s]{0,}$/.test(inputs[i].value)) {
//                formOK = false;
//                mensaje_registro.innerHTML = "Debe rellenar los campos obligatorios";
//                break;
//            }
//        }
//
//        return formOK;
//    }

</script>





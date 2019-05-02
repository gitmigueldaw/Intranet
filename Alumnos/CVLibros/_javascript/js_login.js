//    btnSubmit.addEventListener("click", test);

//    function test() {
//        // Para las veces que se autocompleta el formulario y por lo tanto no se
//        // ejecutaría el evento onBlur().
//        cajaMail.focus();
//        cajaMail.blur();
//
//        cajaPass.focus();
//        cajaPass.blur();
//    }

/* NOTA: Primero se ejecuta el return y luego el success, por lo que el estado
 * resultante de lo que queremos devolver en la función (encontrado) cambia después de retornarla.
 * La variable tendrá que estar en una variable global y cambiarla dependiendo del
 * resultado de la respuesta recibida */
//var encontrado = false;
//function test_usuario_registrado() {
//    mensMail.innerHTML = "";
//    mensPass.innerHTML = "";
//    cajaMail.style.backgroundColor = "white";
//
//    encontrado = false;
//
//    if (cajaMail.value.length > 0) {
//        $.ajax({
//            url: 'Alumnos/CVLibros/proceso_login.php', // la URL para la petición
//            data: {correoLogin: cajaMail.value}, // la información a enviar, con formato objeto de js                    
//            type: 'POST', // especifica si será una petición POST o GET
//            // timeout: 5000, // segundos de espera antes de dar como fallida la recepción
//
//            success: function (respuesta, status, xhr) {
//                // Si no tiene un @, mensaje en blanco. Para que no aparezca el "Disponible"
//                if (!/@{1}/.test(cajaMail.value)) {
//                    mensMail.innerHTML = "";
//                    encontrado = false;
//
//                } else if (respuesta == "no_registrado") {
//                    mensMail.innerHTML = "Ese e-mail no existe.";
//                    encontrado = false;
//
//                    // Borrar mensaje a los 3 segundos
////                    setTimeout(function () {
////                        mensaje_email.innerHTML = "";
////                    }, 2000);
//
//                } else {
//                    cajaMail.style.backgroundColor = "#d3ffc5";  // verde
//                    encontrado = true;
//                }
//            },
//            error: function (xhr, status) {
//                mensMail.innerHTML = "Respuesta no recibida.";
//            },
//            complete: function (xhr, status) {
//            }
//        });
//    }
//}

//var contrasenaOK = false;
//function test_contrasena_valida() {
//    mensPass.innerHTML = "";
//
//    cajaPass.style.backgroundColor = "white";
//
//    if (cajaPass.value.length >= 5) {
//        $.ajax({
//            url: 'Alumnos/CVLibros/proceso_login.php', // la URL para la petición
//            data: {correoLogin: cajaMail.value, passLogin: cajaPass.value}, // la información a enviar, con formato objeto de js                    
//            type: 'POST', // especifica si será una petición POST o GET
//            // timeout: 5000, // segundos de espera antes de dar como fallida la recepción
//
//            success: function (respuesta, status, xhr) {
//                if (respuesta == "pass_ok") {
//                    contrasenaOK = true;
//                    cajaPass.style.backgroundColor = "#d3ffc5";  // verde
//                    btnSubmit.disabled = false;
//                    btnSubmit.style.backgroundColor = "white";  // verde
//
//                } else {
//                    mensPass.innerHTML = "Contraseña incorrecta.";
//                    contrasenaOK = false;
//                    btnSubmit.style.backgroundColor = "#dedede";  // gris
//                    btnSubmit.disabled = true;
//                }
//            },
//            error: function (xhr, status) {
//                mensPass.innerHTML = "Respuesta no recibida.";
//            },
//            complete: function (xhr, status) {
//            }
//        });
//    } 
//}

//function validaForm(formu) {
//    var ok = true;
//
//    if (encontrado == true) {
//        // el valor de "contrasenaOK" se define con el evento input en "test_contrasena_valida()"
//        // "input" porque con change, si al poner el pass, pulsamos en el submit directamente, primero
//        // se comprueba el onSubmit y luego se da valor a "contrasenaOK", por lo que habría que dar
//        // dos veces al submit.
//        ok = contrasenaOK;
//
//    } else {
//        ok = false;
//    }
//
//    return ok;
//}




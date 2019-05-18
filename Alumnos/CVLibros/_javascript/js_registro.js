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

document.addEventListener("readystatechange", cargarEventos, false);
function cargarEventos(event) {
    if (document.readyState == "interactive") {  // fase anterior a complete

        email = document.getElementById("cajaEmail_alu_con");
        mensaje_email = document.getElementById("mens_email_alu_con");
        pass = document.getElementById("cajaPass_alu_con");
        mensaje_pass = document.getElementById("mens_pass_alu_con");
        r_pass = document.getElementById("cajaRepitePass_alu_con");
        mensaje_r_pass = document.getElementById("mens_r_pass_alu_con");
        nombre = document.getElementById("cajaNombre_alu_con");
        mensaje_nombre = document.getElementById("mens_nombre_alu_con");
        telefono = document.getElementById("cajaTelefono_alu_con");
        mensaje_telefono = document.getElementById("mens_telefono_alu_con");
        captcha = document.getElementById("cajaCaptcha_alu_con");
        mensaje_captcha = document.getElementById("mens_captcha_alu_con");
        mensaje_registro = document.getElementById("mensaje_alu_con");

        labelRepite = document.getElementsByTagName("label")[2];
        botonRegistro = document.getElementById("btnRegistrarse_alu_con");

//    document.forms[0].addEventListener("submit", validarForm());
//    botonRegistro.addEventListener("click", );

        labelRepite.style.color = "gray";

        email.addEventListener("change", test_usuario_registrado);
        pass.addEventListener("input", validarPass);
        r_pass.addEventListener("input", validarPassNoRepe);
        telefono.addEventListener("input", validarTelefono);
    }
}

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
            mensaje_pass.innerHTML = "";
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
            mensaje_r_pass.innerHTML = "";
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
            url: 'Alumnos/CVLibros/proceso_registro.php', // la URL para la petición
            data: {correo: email.value}, // la información a enviar, con formato objeto de js                    
            type: 'POST', // especifica si será una petición POST o GET
            // timeout: 5000, // segundos de espera antes de dar como fallida la recepción

            success: function (respuesta, status, xhr) {
                if (respuesta == "ocupado") {
                    mensaje_email.innerHTML = "Este correo ya existe";
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
}

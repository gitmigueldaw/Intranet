// Variables de la pantalla de anuncio detallado
var btnCerrarAnuncio;
var btnEditarAnuncio;
var btnGuardarCambios;
var divCambiaBoton;
var cajaISBN;
var cajaTITULO;
var cajaEDITORIAL;
var cajaESTADO;
var cajaPRECIO;
var inputs;

document.addEventListener("readystatechange", cargarEventos, false);

function cargarEventos(event) {
    if (document.readyState == "interactive") {  // fase anterior a complete
        cajaISBN = document.getElementById("cajaISBN");
        cajaTITULO = document.getElementById("cajaTITULO");
        cajaEDITORIAL = document.getElementById("cajaEDITORIAL");
        cajaESTADO = document.getElementById("cajaESTADO");
        cajaPRECIO = document.getElementById("cajaPRECIO");
        inputs = document.getElementsByTagName("input");

        divCambiaBoton = document.getElementById("cambiaBoton");

        btnCerrarAnuncio = document.getElementById("btnCerrarAnuncio");
        btnCerrarAnuncio.addEventListener("click", borrar_anuncio);

        // La primera vez, el botón es el de editar anuncio
        btnEditarAnuncio = document.getElementById("btnEditarAnuncio");
        btnEditarAnuncio.addEventListener("click", hacer_form_editable);
        btnEditarAnuncio.addEventListener("click", intercambiaBotones);

        // Tocar márgenes por defecto de la zona central del diseño base
        $(".sectionBody").css("margin", "1.5vw 0.5vw");
        $(".margen:first").css("margin", "0");
        $(".section_dos").css("margin-left", "0.7vw");
        $(".acceso a").css("align-self", "flex-end");
        $(".acceso a").css("margin-right", "2vw");
        $(".sectionFooter").css("margin-top", "1vw");

        hacer_form_ineditable();
    }
}

function hacer_form_editable(evento) {
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].readOnly = false;
        inputs[i].style.backgroundColor = "white";
        inputs[i].style.border = "1px solid gray";
    }

    cajaESTADO.readOnly = false;
    cajaESTADO.style.backgroundColor = "white";
    cajaESTADO.style.border = "1px solid gray";
}

function hacer_form_ineditable() {
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].readOnly = true;
        inputs[i].style.backgroundColor = "transparent";
        inputs[i].style.border = "none";
    }

    cajaESTADO.readOnly = true;
    cajaESTADO.style.backgroundColor = "transparent";
    cajaESTADO.style.border = "none";
}

function intercambiaBotones(event) {
    var botonPulsado = event.target;

    // Cada vez que se inserta un botón en el div con innerHTML, crear los escuchadores
    if (botonPulsado.id == "btnEditarAnuncio") {
        divCambiaBoton.innerHTML = '<button class="boton_edit_alu_com" id="btnGuardarCambios">Guardar cambios</button>';
        btnGuardarCambios = document.getElementById("btnGuardarCambios");
        btnGuardarCambios.addEventListener("click", guardar_formu);
        btnGuardarCambios.addEventListener("click", intercambiaBotones);

    } else if (botonPulsado.id == "btnGuardarCambios") {
        divCambiaBoton.innerHTML = '<button class="boton_edit_alu_com" id="btnEditarAnuncio">Editar anuncio</button>';
        btnEditarAnuncio = document.getElementById("btnEditarAnuncio");
        btnEditarAnuncio.addEventListener("click", hacer_form_editable);
        btnEditarAnuncio.addEventListener("click", intercambiaBotones);
    }
}

function guardar_formu(evento) {
    hacer_form_ineditable();

    var objetoJS = new Object();
    objetoJS.id = idAnuncio;
    objetoJS.isbn = cajaISBN.value;
    objetoJS.titulo = cajaTITULO.value;
    objetoJS.editorial = cajaEDITORIAL.value;
    objetoJS.estado = cajaESTADO.value;
    objetoJS.precio = cajaPRECIO.value;

    $.ajax({
        url: "Alumnos/CVLibros/editar_borrar_anuncio.php",
        type: "POST",
        data: objetoJS,
        success: function (respuesta, status, xhr) {
            if (respuesta == "modificado") {
                // Función de jquery-confirm.min.js
                $.alert({
                    type: 'blue',
                    boxWidth: '35%',
                    title: '',
                    content: '<span style="font-family: Lora, serif; font-weight: bold;">Modificación correcta.</span>',
                    buttons: {
                        cerrar: {
                            text: '<span style="font-family: Lora, serif;font-weight: normal">Volver</span>',
                            btnClass: 'btn-blue',
                            keys: ['enter'],
                            action: function () {
                            }
                        },
                    }
                });

            } else {
                // Función de jquery-confirm.min.js
                $.alert({
                    type: 'blue',
                    boxWidth: '35%',
                    title: '',
                    content: '<span style="font-family: Lora, serif; font-weight: bold;">No se ha modificado el anuncio.</span>',
                    buttons: {
                        cerrar: {
                            text: '<span style="font-family: Lora, serif; font-size: 1.2vw; font-weight: normal">Volver</span>',
                            btnClass: 'btn-blue',
                            keys: ['enter'],
                            action: function () {
                            }
                        },
                    }
                });
            }
        },
        error: function (xhr, status) {
            // Función de jquery-confirm.min.js
            $.alert({
                type: 'red',
                boxWidth: '35%',
                title: '',
                content: '<span style="font-family: Lora, serif; font-weight: bold;">Ha occurrido un error.</span>',
                buttons: {
                    cerrar: {
                        text: '<span style="font-family: Lora, serif; font-size: 1.2vw;font-weight: normal">Volver</span>',
                        btnClass: 'btn-red',
                        keys: ['enter'],
                        action: function () {
                        }
                    },
                }
            });
        },

        complete: function (xhr, status) {
        }
    })
}


function borrar_anuncio(evento) {

    // Función de jquery-confirm.min.js
    $.confirm({
        autoClose: 'cancelar|6000',
        type: 'red',
        boxWidth: '35%',
        title: '<span style="font-family: Lora, serif;font-weight: bold;">Eliminar anuncio</span>',
        content: '<span style="font-family: Lora, serif;">¿Estás seguro de borrar el anuncio?</span>',
        buttons: {
            confirmar: {
                text: '<span style="font-family: Lora, serif; font-size: 1.2vw;font-weight: normal">Borrar</span>',
                btnClass: 'btn-red',
                keys: ['enter'],
                action: function () {
                    $.ajax({
                        url: "Alumnos/CVLibros/editar_borrar_anuncio.php",
                        type: "POST",
                        data: {borrarlo: idAnuncio},
                        success: function (respuesta, status, xhr) {
                            if (respuesta == "borrado") {

                                // Función de jquery-confirm.min.js
                                $.alert({
                                    type: 'blue',
                                    boxWidth: '35%',
                                    title: '<span style="font-family: Lora, serif; font-weight: bold;">Proceso correcto</span>',
                                    content: '<span style="font-family: Lora, serif;">El anuncio fue borrado con éxito.</span>',
                                    buttons: {
                                        volver: {
                                            text: '<span style="font-family: Lora, serif;font-size: 1.2vw;font-weight: normal">Volver</span>',
                                            btnClass: 'btn-blue',
                                            keys: ['enter'],
                                            action: function () {
                                                document.location.href = '?alu_com';
                                            }
                                        },
                                    }
                                });

                            } else {

                                // Función de jquery-confirm.min.js
                                $.alert({
                                    type: 'red',
                                    boxWidth: '35%',
                                    title: '<span style="font-family: Lora, serif; font-weight: bold;">Ha ocurrido un error</span>',
                                    content: '<span style="font-family: Lora, serif;">No se ha podido borrar el anuncio.</span>',
                                    buttons: {
                                        volver: {
                                            text: '<span style="font-family: Lora, serif;font-size: 1.2vw;font-weight: normal">Volver</span>',
                                            btnClass: 'btn-red',
                                            keys: ['enter'],
                                            action: function () {
                                            }
                                        },
                                    }
                                });
                            }
                        }
                    })
                }
            },

            cancelar: {
                text: '<span style="font-family: Lora, serif; font-size: 1.2vw;font-weight: normal">Cancelar</span>',
                btnClass: 'btn-blue',
                action: function () {
                }
            }
        }
    });
}
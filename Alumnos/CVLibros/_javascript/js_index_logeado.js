// Variables del index (selección de anuncio)
var arrayAnuncios;  // global para guardar los anuncios y obtener la ID del TR pulsado, mediante la función "obtener_ID_de_TR()"
var divRespuesta;
var divMini_Boton;
var elSelect;
var btnAnunciosLogeado;


document.addEventListener("readystatechange", cargarEventos, false);
function cargarEventos(event) {
    if (document.readyState == "interactive") {  // fase anterior a complete

        // Variables del index (selección de anuncio)
        arrayAnuncios = new Array();
        divRespuesta = document.getElementById("resp_alu_com");
        divMini_Boton = document.getElementById("foto_alu_com");
        elSelect = document.getElementById("elSelect_alu_com");
        btnAnunciosLogeado = document.getElementById("btnVerAnunciosLogeado_alu_com");

        elSelect.addEventListener("change", pedirAnunciosAjax);
        btnAnunciosLogeado.addEventListener("click", pedirAnunciosLogeado);

        // Tocar márgenes por defecto de la zona central del diseño base
        $(".sectionBody").css("margin", "1.5vw 0.5vw");
        $(".margen:first").css("margin", "0");
        $(".section_dos").css("margin-left", "0.7vw");
        $(".acceso a").css("align-self", "flex-end");
        $(".acceso a").css("margin-right", "2vw");
        $(".sectionFooter").css("margin-top", "1vw");
    }
}

function pedirAnunciosLogeado(evento) {
    divRespuesta.innerHTML = "";
    divMini_Boton.innerHTML = "";
    elSelect.selectedIndex = 0;  // Quitar la seleccion al select

    $.ajax({
        url: "Alumnos/CVLibros/get_JSON_anuncios.php",
        type: "POST",
        data: {mail_vendedor_alu_com: emailLogeado},
        success: function (respuesta, status, xhr) {
            var array = JSON.parse(respuesta);

            if (array.length == 0) {
                divRespuesta.innerHTML = '<h3 style="margin-left: 22vw;">Actualmente no tiene libros a la venta</h3>';

            } else {
                // Guardar el array de anuncios para usar en la función "obtener_id_de_tr()"
                arrayAnuncios = array;
                crearTablaAnuncios(array);
            }



        },
        error: function (xhr, status) {
            divRespuesta.innerHTML = "Respuesta no recibida.";
            // document.getElementById("#estadoCuenta").innerHTML = "Datos no recibidos";
        }
    })
}

// Variable global para guardar los anuncios y obtener la ID del TR pulsado, mediante
// la función "obtener_ID_de_TR()"
function pedirAnunciosAjax(evento) {
    divRespuesta.innerHTML = "";
    divMini_Boton.innerHTML = "";

    var valor = evento.target.value;

    if (valor > 0) {
        $.ajax({
            url: "Alumnos/CVLibros/get_JSON_anuncios.php",
            type: "POST",
            data: {rango_alu_com: valor},
            success: function (respuesta, status, xhr) {
                var array = JSON.parse(respuesta);

                // Guardar el array de anuncios para usar en la función "obtener_id_de_tr()"
                arrayAnuncios = array;
                crearTablaAnuncios(array);

            },
            error: function (xhr, status) {
                divRespuesta.innerHTML = "Respuesta no recibida.";
                // document.getElementById("#estadoCuenta").innerHTML = "Datos no recibidos";
            }
        })
    }


}

function crearTablaAnuncios(array) {

    // CREACION DE LA TABLA  ********************************************************************
    var tabla = document.createElement("table");
    tabla.setAttribute("class", "laTabla_alu_com");

    // CREAR LA FILA DE THs con los nombres de los datos. ----------------
    var tr = document.createElement("tr");

    // Solo mostrar ciertas columnas y cambiarles el nombre.
    for (var indice in array[0]) {

        if (indice == "isbn" || indice == "titulo" || indice == "editorial" || indice == "precio" || indice == "fecha") {  // || indice == "foto"
            var th = document.createElement("th");

            if (indice == "isbn") {
                indice = "ISBN"
            } else if (indice == "titulo") {
                indice = "TÍTULO";
            } else if (indice == "editorial") {
                indice = "EDITORIAL";
            } else if (indice == "precio") {
                indice = "PRECIO";
            } else if (indice == "fecha") {
                indice = "FECHA";
            }

            th.appendChild(document.createTextNode(indice));
            tr.appendChild(th);
        }
    }

    tabla.appendChild(tr);

//              CREAR FILAS. ----------------------------------------------------------
    for (var i = 0; i < array.length; i++) {
        var tr = document.createElement("tr");
        tr.setAttribute("class", "losTRs_alu_com");

        for (var indice in array[i]) {

            if (indice == "isbn" || indice == "titulo" || indice == "editorial" || indice == "precio" || indice == "fecha" || indice == "foto") {
                var td = document.createElement("td");

                // Si es una fecha, pasarla del formato yyyy-mm-dd  a  dd-mm-yyyy
                if (/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/.test(array[i][indice])) {
                    var arrayFecha = array[i][indice].split("-");
                    var formateada = arrayFecha[2] + "-" + arrayFecha[1] + "-" + arrayFecha[0];

                    td.appendChild(document.createTextNode(formateada));
                    tr.appendChild(td);

                    // Si es el precio, añadir el símbolo del euro o consultar
                } else if (indice == "precio") {
                     var val;
                    
                    if(array[i][indice] == 0){
                        val = "Consultar";
                    } else {
                        val = array[i][indice] + "€";
                    }
                    
                    
                    td.appendChild(document.createTextNode(val));
                    tr.appendChild(td);

                    // Si el campo foto, mostrar un iconito
                } else if (indice == "foto") {
                    var src;

                    if (array[i][indice] != null) {
                        src = "Alumnos/CVLibros/imgs/si.png";
                    } else if (array[i][indice] == null) {
                        src = "Alumnos/CVLibros/imgs/no.png";
                    }

                    var img = document.createElement("img");
                    img.setAttribute("src", src);
                    img.setAttribute("alt", "sin_foto");

                   // td.style.border = "none"; // Quitar el borde al td de la foto
                    td.appendChild(img);

                    // Qitar los eventos que saltan al pasar el puntro por la fila
                    // cuando se pasa por encima del td de la imagen
                    td.addEventListener("mouseover", function (evento) {
                        // soluciona que el puntero no se cambiaba en todas las filas
                        evento.stopPropagation();

                        td.style.cursor = 'default';                       
                        td.parentNode.style.backgroundColor = 'white';
//                        td.style.backgroundColor = 'white';
                    });

                    // impedir que se vea la miniatura al hacer click en la fotito
                    td.addEventListener("click", function (evento) {
                        evento.stopPropagation();
                    });

                    tr.appendChild(td);

                } else {
                    td.appendChild(document.createTextNode(array[i][indice]));
                    tr.appendChild(td);
                }

                /* PROBLEMA: Se aplica a los TD no al TR. Con parentNode se aplica
                 * a todos los TD y se soluciona */
                tr.addEventListener("mouseover", function (evento) {
                    evento.target.parentNode.style.backgroundColor = "#deedfa";
                    document.body.style.cursor = 'pointer';
                });

                tr.addEventListener("mouseout", function (evento) {
                    evento.target.parentNode.style.backgroundColor = "white";
                    document.body.style.cursor = 'default';
                });

                tr.addEventListener("click", mostrarMiniatura_y_enlace);
            }
        }

        tabla.appendChild(tr);
    }

    // Finalmente limpiar y añadir la tabla como hija del div
    divRespuesta.innerHTML = "";
    divRespuesta.appendChild(tabla);
}

function mostrarMiniatura_y_enlace(evento) {
    divMini_Boton.innerHTML = '';

    // evento.target.parentNode para que sea el TR, no el TD
    var id = obtener_ID_de_TR(evento.target.parentNode);

    /* Obtener el src del ultimo TD del TR (la fotito que muestra si el anuncio
     * tiene foto o no) y buscar en el src si acaba en "si.png" o no. 
     * Si acaba en "si.png", mostrar la miniatura real al hacer clic en el TR
     * Si no acaba en "si.png", mostrar la miniatura standard. */

    var src;
    var elTR = evento.target.parentNode;
    var srcDeImagen = elTR.childNodes[5].childNodes[0].src;

    if (/si.png$/.test(srcDeImagen)) {
        src = "Alumnos/CVLibros/fotos/" + id + "/" + id + "_mini.jpg";
    } else {
        src = "Alumnos/CVLibros/imgs/no_foto_mini.png";
    }

    var img = document.createElement("img");
    img.setAttribute("src", src);
    img.setAttribute("alt", "foto.png");

    divMini_Boton.appendChild(img);

    // El enlace será un pequeño formulario, para poder mandar pos POST
    // y que no se vea la ID del anuncio.
    var form = document.createElement("form");
    form.setAttribute("id", "elMiniFormu_alu_com");
//    form.setAttribute("action", "Alumnos/CVLibros/controlador/c_anuncio/controlador_anuncio_existente.php");
    form.setAttribute("action", "?alu_com&veranuncio");
    form.setAttribute("method", "POST");
//    form.setAttribute("target", "_blank");

    // Input hidden con el id del anuncio
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("value", id);
    input.setAttribute("name", "idAnuncio");

    form.appendChild(input);

    // El botón de tipo submit
    var boton = document.createElement("input");
    boton.setAttribute("id", "botonVerAnuncio_alu_com");
    boton.setAttribute("type", "submit");
    boton.setAttribute("value", "Ver anuncio detallado");
    boton.setAttribute("name", "btnSubmit");
    boton.setAttribute("class", "boton2_alu_com");

    form.appendChild(boton);

    divMini_Boton.appendChild(form);
}

/* Para saber el id del anuncio en el que hacemos click, no se puede
 * a través de los datos de la misma tabla porque no está el ID, por 
 * lo que creo un array de IDs EN ORDEN, a partir del array de anuncios.
 * Luego busco el ID del TR clickado para saber a qué anuncio equivale. 
 */
function obtener_ID_de_TR(fila) {
    var trs = document.getElementsByTagName("tr");
    var indice_fila = -1;

    // Buscar la fila recibida en el array de anuncios, para obtener el índice
    for (var i = 0; i < trs.length; i++) {
        if (fila == trs[i]) {
            indice_fila = i;
            break;
        }
    }

    // Obtener los IDs de los anuncios y asignar el ID correspondiente de ese TR
    var arrayIDS = new Array();

    for (var i = 0; i < arrayAnuncios.length; i++) {
        arrayIDS.push(arrayAnuncios[i].id);
    }

    // -1 porque también cuenta como TR la fila de los títulos
    return arrayIDS[indice_fila - 1];
}

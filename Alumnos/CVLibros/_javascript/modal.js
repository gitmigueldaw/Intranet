var modal;
var btn;
var span;

document.addEventListener("readystatechange", cargarEventos, false);
function cargarEventos(event) {
    if (document.readyState == "interactive") {  // fase anterior a complete
        // Get the modal
        modal = document.getElementById('myModal_alu_com');
        span = document.getElementsByClassName("close_alu_com")[0];

        modal.style.display = "block";


        // Cerrar al pulsar la X
        span.onclick = function () {
            modal.style.display = "none";
        }

        // Cerar al pulsar en cualquier sitio excepto en la ventana
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
}



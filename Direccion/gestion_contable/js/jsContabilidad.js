document.getElementById("departamentos").addEventListener("change", function () {
    var e = this.selectedIndex;
    localStorage.setItem("index", e);
    document.getElementById("formularioContable").submit();
});

if (localStorage.getItem("index") !== null) {
    document.getElementById("departamentos").options[parseInt(localStorage.getItem("index"))].selected = "selected";
}

var aBorrar = document.getElementsByClassName("borrar");

for (var i = 0; i < aBorrar.length; i++) {
    aBorrar[i].addEventListener("click", function (evnt) {
//        evnt.preventDefault();
        //FALTA VER COMO MANDAR UN POST AL PHP PARA QUE SEPA LAS SIGLAS
        var con = confirm("¿Desea borrar el registro?");
        if (con === true) {
//            var http = new XMLHttpRequest();
//            var url = this.href; //URL del servidor
            var dept = document.getElementById("departamentos").options[document.getElementById("departamentos").selectedIndex].value; //PARAMETROS
//            var params = "dept=" + dept;
//            //Abres la conexion  la URL
//            http.open("POST", url, true);
//
//            http.onreadystatechange = function () { //Llama a la funcion cuando el estado cambia
//                if (http.readyState == 4 && http.status == 200) {
//                    //alert(http.responseText);
//                    window.location.reload();
//                }
//            }
//            http.send(params);
            //window.location.href = window.location.href + dept;
        } else {
            window.location.href = "?dirges";
        }
    });
}

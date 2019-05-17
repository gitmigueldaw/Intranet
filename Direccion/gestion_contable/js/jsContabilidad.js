//cuando cambia el select hago un submit para ver los elementos de ese deprt
document.getElementById("departamentos").addEventListener("change", function () {
    var e = this.selectedIndex;
    //guardo el indice del elemento seleccionado
    localStorage.setItem("index", e);
    document.getElementById("formularioContable").submit();
});

//vuelvo a seleccionar el elemento del Select que estaba selecionado
if (localStorage.getItem("index") !== null) {
    document.getElementById("departamentos").options[parseInt(localStorage
            .getItem("index"))].selected = "selected";
}

//las anclas
var aBorrar = document.getElementsByClassName("borrar");

//añado un evento de click para la ventana emergente 
for (var i = 0; i < aBorrar.length; i++) {
    aBorrar[i].addEventListener("click", function (evnt) {
        //quito el funcionamiento normal del elemento
        evnt.preventDefault();
        
        //el valor del atributo href del elemento a
        var href = evnt.target.getAttribute('href');
        
        //valor departamento cogido del select > option
        var dept = document.getElementById("departamentos").options[document
                .getElementById("departamentos").selectedIndex].value;
    
        //ventana de confirmacion
        var con = confirm("¿Desea borrar el registro?");
        if (con === true) {
            //creo URI con la URL base + los atributos del HREF + las iniciales 
            //del departamento
            window.location = (window.location.href.split("?")[0]) + href + "&departamento=" + dept;
        } else {
            //creo URI solo con la URL base y el departamento para que me siga 
            //mostrando la lista
            window.location.href = "?dirges&departamento=" + dept;
        }
    });
}

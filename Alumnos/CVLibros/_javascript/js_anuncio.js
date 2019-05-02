document.addEventListener("readystatechange", cargarEventos, false);

function cargarEventos(event) {
    if (document.readyState == "interactive") {  // fase anterior a complete

        // Tocar márgenes por defecto de la zona central del diseño base
        $(".sectionBody").css("margin", "1.5vw 0.5vw");
        $(".margen:first").css("margin", "0");
        $(".section_dos").css("margin-left", "0.7vw");
        $(".acceso a").css("align-self", "flex-end");
        $(".acceso a").css("margin-right", "2vw");
        $(".sectionFooter").css("margin-top", "1vw");

    }
}
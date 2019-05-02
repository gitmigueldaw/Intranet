window.onload = function () {

    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    var imagenes = document.getElementsByTagName('img');

    if (isMobile.any()) {
        var img1 = imagenes[0];

        img1.src = "Portada/img/web1_movil.png"; //imagen para el movil
        imagenes[1].src = "Portada/img/web2_movil.png";

        img1.addEventListener("click", function () {
            document.getElementsByTagName("figure")[1].classList.add("desaparecer");
            document.getElementsByClassName("login")[0].classList.add("login-up");
            document.getElementsByTagName("html")[0].setAttribute("style", "height: 100%;");
        });

        imagenes[1].addEventListener("click", function () {
            window.location.href = "https://www.educa2.madrid.org/web/tiernogalvan";
        });

        document.getElementById("salir").addEventListener("click", function () {
            document.getElementsByTagName("figure")[1].classList.remove("desaparecer");
            document.getElementsByClassName("login")[0].classList.remove("login-up");
        });

        document.getElementById("entrar").addEventListener("click", function (event) {
            event.preventDefault();
            document.getElementsByTagName("figcaption")[0].classList.add("desaparecer");
            document.getElementsByClassName("login")[0].classList.add("desaparecer");
            document.getElementsByClassName("titulo-h1")[0].classList.add("desaparecer");


            img1.setAttribute("style", "height:" + (window.outerHeight - 74) + "px !important; transition: 3s; transition-timing-function: ease-in-out;");

            setTimeout(function () {
                window.location.href = "index.php?ini"; //ruta desde index
            }, 2000);
        });

    } else {

        if (localStorage.getItem('fallido') != null) {
            imagenes[1].classList.add("desaparecer");
            document.getElementsByClassName("cont-2")[0].classList.add("desaparecer");
            document.getElementsByClassName("cont-1")[0].classList.add("total");
            imagenes[0].removeEventListener("mouseleave", clases2);

            document.getElementsByClassName("login")[0].classList.add("login-up");
            document.getElementsByClassName("desc-1")[0].setAttribute("style", "width: 60%; transition: 0s;");
            document.getElementsByClassName("desc-2")[0].classList.add("desaparecer");

            imagenes[0].classList.add("imgSalir");
        } else {

            function clases() {
                imagenes[0].classList.remove("img");
                imagenes[0].classList.add("aumento");
            }

            function clases2() {
                imagenes[0].classList.add("img");
                imagenes[0].classList.remove("aumento");
            }

            imagenes[0].addEventListener("mouseenter", clases);
            imagenes[0].addEventListener("mouseleave", clases2);

            imagenes[0].addEventListener("click", function () {
                imagenes[1].classList.add("desaparecer");
                document.getElementsByClassName("cont-2")[0].classList.add("desaparecer");
                document.getElementsByClassName("cont-1")[0].classList.add("total");
                imagenes[0].removeEventListener("mouseleave", clases2);

                document.getElementsByClassName("login")[0].classList.add("login-up"); //los px son de la clase aumento

                document.getElementsByClassName("desc-1")[0].classList.add("desc1-up");
                document.getElementsByClassName("desc-2")[0].classList.add("desaparecer");
            });

            document.getElementById("entrar").addEventListener("click", function (event) {
                if (window.location.href.split("?")[1] != "log") {
                    localStorage.setItem('fallido', 'a');
                }

            });

            imagenes[1].addEventListener("mouseenter", function () {
                this.classList.remove("img");
                this.classList.add("aumento");
            });

            imagenes[1].addEventListener("mouseleave", function () {
                this.classList.remove("aumento");
                this.classList.add("img");
            });

            imagenes[1].addEventListener("click", function () {
                imagenes[0].classList.add("desaparecer");
                document.getElementsByClassName("cont-1")[0].classList.add("desaparecer");
                document.getElementsByClassName("cont-2")[0].classList.remove("cont-2");
                document.getElementsByTagName("html")[0].setAttribute("style", "height: 100%;");
                document.getElementsByClassName("titulo-h1")[0].classList.add("desaparecer");
                document.getElementsByClassName("descripcion")[0].classList.add("desaparecer");
                document.getElementsByClassName("container")[0].setAttribute("style", "justify-content: center;");

                this.setAttribute("style", "width:" + (window.outerWidth - 17) + "px; height:" +
                    (window.outerHeight - 74) + "px; transition: 3s; transition-timing-function: ease-in-out;");

                setTimeout(function () {
                    window.location.href = "https://www.educa2.madrid.org/web/tiernogalvan";
                }, 1900);
            });
        }
    }
    
    document.getElementById("salir").addEventListener("click", function () {

        localStorage.removeItem('fallido');

        imagenes[1].classList.remove("desaparecer");
        document.getElementsByClassName("cont-2")[0].classList.remove("desaparecer");
        document.getElementsByClassName("cont-1")[0].classList.remove("total");
        imagenes[0].addEventListener("mouseleave", clases2);
        imagenes[0].classList.remove("aumento");
        document.getElementsByClassName("login")[0].classList.remove("login-up");
        document.getElementsByClassName("desc-1")[0].classList.remove("desc1-up");
        document.getElementsByClassName("desc-2")[0].classList.remove("desaparecer");

        imagenes[0].classList.remove("imgSalir");
        // location.reload();
        document.getElementById("error").setAttribute("style", "display: none;");

    });

    if (window.location.href.split("?")[1] == "log") {
        document.getElementsByClassName("login")[0].classList.add("desaparecer");
        document.getElementsByTagName("html")[0].setAttribute("style", "height: 100%;");
        imagenes[0].setAttribute("style", "width:" + window.outerWidth + "px; height:" + (window.outerHeight - 70) + "px; transition: 3s; transition-timing-function: ease-in-out;");
        document.getElementsByClassName("container")[0].setAttribute("style", "justify-content: center;");
        document.getElementsByClassName("total")[0].setAttribute("style", "width: 100%;");
        document.getElementsByTagName("figure")[0].setAttribute("style", "align-items: center;")
        var elQuitar = document.getElementsByClassName("fuera");
        for (var i = 0; i < elQuitar.length; i++) {
            elQuitar[i].setAttribute("style", "display: none;")
        }

        setTimeout(function () {
            window.location.href = "index.php?ini"; //ruta desde index
        }, 2700);
    }

    var inputs = document.getElementsByTagName("input");
    inputs[0].addEventListener("click", function () {
        this.classList.add("click-placeholder");
    });
    inputs[1].addEventListener("click", function () {
        this.classList.add("click-placeholder");
    });
    inputs[0].addEventListener("blur", function () {
        this.classList.remove("click-placeholder");
    });
    inputs[1].addEventListener("blur", function () {
        this.classList.remove("click-placeholder");
    });

}

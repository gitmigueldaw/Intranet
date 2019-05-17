/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var slideIndex = 1;

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function currentDiv(n) {
    showDivs(slideIndex = n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("badge");

    if (n > x.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = x.length;
    }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" white", "");
    }
    x[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " white";
}
showDivs(slideIndex);
window.onload = function () {
    setInterval("plusDivs(1)", 3000); //parar el slide automatico

    document.getElementById("desc").addEventListener("click", function () {
        localStorage.removeItem('fallido');
        localStorage.removeItem('index');
    });
};

function fechaHoy() {
    var dt = new Date();
    var month = dt.getMonth() + 1;
    var day = dt.getDate();
    var year = dt.getFullYear();
    var hours = dt.getHours();
    var min = dt.getMinutes();

    if (min < 10) {
        document.getElementById('fecha').innerHTML = hours + ":0" + min + ", " + day + "/" + month + "/" + year;
    } else {
        document.getElementById('fecha').innerHTML = hours + ":" + min + ", " + day + "/" + month + "/" + year;
    }
}

setInterval("fechaHoy()", 1000);


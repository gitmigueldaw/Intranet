<div class="flex-container">
    <header>
        <div class="cabecera">
            <div class="logo">
                <a href="?ini"><img src="Comun/img/logo2.png" alt="Logo del instituto"></a>
            </div>
            <div class="izquierdaCabecera">
                <div class="nombreInsti">
                    <span>I.E.S. Enrique Tierno Galvan</span>
                </div>

                <div class="usuario">
                    <div class="content-usuario">
                        <h3>Bienvenido <br><?php echo $_COOKIE['nombre']; ?></h3>
                        <div class="desc">
                            <a href="?desc" id="desc">Salir</a>
                        </div>
                    </div> 
                </div>
                <script>
                    window.onload = function () {
                        setInterval("plusDivs(1)", 3000); //parar el slide automatico

                        document.getElementById("desc").addEventListener("click", function () {
                            localStorage.removeItem('fallido');
                            localStorage.removeItem('index');
                        });
                    };
                </script>
            </div>
        </div>

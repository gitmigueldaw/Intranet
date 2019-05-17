<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/portada.css">
        <link rel="stylesheet" href="css/portada.movil.css" media="screen and (max-width:500px)">
        <link rel="icon" type="image/png" sizes="32x32" href="Comun/img/favicon-32x32.png">
        <title>Entrada</title>
    </head>

    <body>
        <div class="container">
            <div class="titulo-h1 fuera">
                <h1>Selección Web</h1>
            </div>
            <div class="descripcion fuera">
                <div class="desc-1">
                    <h2>Intranet/Acceso Privado</h2>
                </div>
                <div class="desc-2">
                    <h2>Acceso Público/EducaMadrid</h2>
                </div>
            </div>
            <div class="raya">
                <div class="cont-1">
                    <div class="caja">
                        <figure>
                            <img src="Portada/img/web1.png" alt="web1">
                            <div class="login">
                                <h2>Login</h2>
                                <?php
                                if (!isset($_POST['login'])) {
                                    ?>
                                    <form class="entrada" method="post" name="entrada">
                                        <div class="pre-icono">
                                            <div class="icono">
                                                <i class="icono-loggin"></i>
                                            </div>
                                            <input type="text" name="login" placeholder="Usuario" required>
                                        </div>
                                        <br>
                                        <div class="pre-icono">
                                            <div class="icono">
                                                <i class="icono-password"></i>
                                            </div>
                                            <input type="password" name="pass" placeholder="Contraseña" required>
                                        </div><br>
                                        <div id="error"></div>
                                        <input class="boton" type="submit" value="Entrar" id="entrar"><br>
                                        <input class="boton" type="button" value="Salir" id="salir">
                                    </form>
                                    <?php
                                } else {
                                    include_once 'Comun/conexion.php';

                                    $cl_conexion = new Conexion();

                                    $usuario = $_POST['login'];
                                    $contrasenia = md5($_POST['pass']);

                                    if ($cl_conexion->comprobarConexion($usuario, $contrasenia) > 0) {
                                        header("Location: ?log");
                                    } else {
                                        ?>
                                        <form class="entrada" method="post" name="entrada">
                                            <div class="pre-icono">
                                                <div class="icono">
                                                    <i class="icono-loggin"></i>
                                                </div>
                                                <input type="text" name="login" placeholder="Usuario" required value="<?php echo $_POST['login']; ?>">
                                            </div>
                                            <br>
                                            <div class="pre-icono">
                                                <div class="icono">
                                                    <i class="icono-password"></i>
                                                </div>
                                                <input type="password" name="pass" placeholder="Contraseña" required value="<?php echo $_POST['pass']; ?>">
                                            </div><br>
                                            <div id="error">Datos Incorrectos</div>
                                            <input class="boton" type="submit" value="Entrar" id="entrar"><br>
                                            <input class="boton" type="button" value="Salir" id="salir">
                                        </form>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <figcaption>Acceso Privado</figcaption>
                        </figure>
                    </div>
                </div>
                <div class="cont-2">
                    <div class="caja2">
                        <figure>
                            <img src="Portada/img/web2.png" alt="web2">
                            <figcaption>Acceso Público</figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
        <script src="Portada/js/script.js"></script>
    </body>

</html>

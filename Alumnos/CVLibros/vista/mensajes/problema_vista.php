<div class="cuerpo_alu_com">
    <h1>&nbsp;</h1>
    <h2>
        Ha habido un problema subiendo la imagen: <br>
    </h2>

    <!-- Reutilizo esta variable para los mensajes de error -->
    <p><?php echo $_SESSION['MENS_FOTO_alu_com']; ?></p>

    <br><br>

    <a class="hvr-grow-shadow boton_alu_com" href="?alu_com">Ir al índice</a>
</div>

<!------------------------------------------------------------------------------------->

<!-- jquery online -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>-->

<!-- Cargar el local si el CDN (online) no responde --> 
<script>
    if (window.jQuery === undefined)
        document.write('<script src="js/jquery-3.3.1.min.js"><\/script>');
</script>  

<!-- Mi javascript -->
<script src="Alumnos/CVLibros/_javascript/js_anuncio.js" type="text/javascript"></script> 

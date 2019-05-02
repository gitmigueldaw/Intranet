<!DOCTYPE html>
<html lang="es">
    <head>
        <title><?php echo $titulo; ?></title>  
        <meta charset="<?php echo $charset; ?>"/>		
        <meta name="author" content="<?php echo $autor; ?>"/>

        <!-- jquery online -->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

        <!-- Cargar el local si el CDN (online) no responde --> 
        <script>
            if (window.jQuery === undefined)
                document.write('<script src="../../_javascript/_jquery/jquery-3.3.1.min.js"><\/script>');
        </script>  

        <!-- Mi javascript -->
        <script src="../../_javascript/js_anuncio_CRUD.js" type="text/javascript"></script> 
    </head>
    <body>
        <?php
//        echo basename($_SERVER['PHP_SELF']);
//        die();

        include 'anuncio_CRUD_plantilla.php';
        ?>
    </body>
</html>
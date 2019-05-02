<h1>Anuncio detallado</h1>

<h4>ISBN:</h4>
<p><?php echo $anuncio['isbn']; ?></p>

<h4>TÍTULO:</h4>
<p><?php echo $anuncio['titulo']; ?></p>

<h4>EDITORIAL:</h4>
<p><?php echo $anuncio['editorial']; ?></p>

<h4>ESTADO:</h4>
<p><?php echo $anuncio['estado']; ?></p>

<h4>PRECIO:</h4>
<p><?php echo $anuncio['precio'] . '€'; ?></p>

<h4>FECHA DEL ANUNCIO:</h4>
<p><?php echo $fechaFormateada; ?></p>

<?php if ($anuncio['foto'] != null) { ?>
    <h4>IMAGEN: (click para tamaño completo)</h4>

    <p>
        <a href="<?php echo $dirFoto; ?>" target="_blank">
            <img src="<?php echo $dirMiniatura; ?>" alt="foto">
        </a>
    </p>
<?php } else { ?>
    <h4>IMAGEN: </h4>
    <p>Sin imagen</p>

<?php } ?>

<h3>DATOS DE CONTACTO DEL VENDEDOR:</h3>
<h4>Nombre:</h4>
<p><?php echo $anuncio['nombre']; ?></p>

<h4>Teléfono:</h4>
<?php if ($anuncio['telefono'] != null) { ?>
    <p><?php echo $anuncio['telefono']; ?></p>

<?php } else { ?>
    <p>Sin teléfono</p>
<?php } ?>

<h4>Correo electrónico:</h4>
<p><?php echo $anuncio['email_vendedor']; ?></p>



<h1>Anuncio detallado</h1>

<div>Version CRUD</div>

<div id="cambiaBoton">
    <button id="btnEditarAnuncio">Editar anuncio</button>
</div>

<button id="btnCerrarAnuncio">Borrar anuncio</button>
<!--<button id="btnEditarAnuncio">Editar anuncio</button>
<button id="btnGuardarCambios">Guardar cambios</button>-->

<div>
    <label for="cajaISBN">- ISBN:</label>
    <input type="text" id="cajaISBN" value="<?php echo $anuncio['isbn']; ?>" readonly="readonly">
</div>

<div>
    <label for="cajaTITULO">- Titulo:</label>
    <input type="text" id="cajaTITULO" value="<?php echo $anuncio['titulo']; ?>" readonly="readonly">
</div>

<div>
    <label for="cajaEDITORIAL">- Editorial:</label>
    <input type="text" id="cajaEDITORIAL" value="<?php echo $anuncio['editorial']; ?>" readonly="readonly">
</div>

<div>
    <label for="cajaESTADO">- Estado:</label>
    <input type="text" id="cajaESTADO" value="<?php echo $anuncio['estado']; ?>" readonly="readonly">
</div>

<div>
    <label for="cajaPRECIO">- Precio:</label>
    <input type="text" id="cajaPRECIO" value="<?php echo $anuncio['precio']; ?>" readonly="readonly"> euros.
</div>

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



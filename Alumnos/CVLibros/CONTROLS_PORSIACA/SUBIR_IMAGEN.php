<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <form action="" method="post" enctype="multipart/form-data"> 

            Elije tu imagen:
            <input type="file" name="archivo_a_subir" id="inputFile">
            <input type="submit" value="Upload Image" name="submit">
        </form>


        <?php
        if (isset($_POST["submit"])) {

            $uploadOk = true;
            $idVenta = '1';

            $nombre_archivo_subido = strtolower($_FILES['archivo_a_subir']['name']); // por si la extension estuviera en mayúscula
            $extension_archivo_subido = explode('.', $nombre_archivo_subido)[1]; // explode, como el split de javascript 

            $directorio_destino = './fotos/' . $idVenta;
            $ruta_destino_imagen_final = $directorio_destino . '/' . $idVenta . '.jpg';
            $ruta_destino_imagen_ext_original = $directorio_destino . '/' . $extension_archivo_subido;

            //**********************************************************************************************

//            if (!getimagesize($_FILES["archivo_a_subir"]["tmp_name"])) {
//                echo "Debes subir un archivo de imagen. ";
//                $uploadOk = false;
//            }

            // Comprobar tamaño del fichero
            if ($_FILES["archivo_a_subir"]["size"] > 2000000) { // 40000bits, 40KB   -   2000000bits, 2MB
                echo "Imagen demasiado pesada. Máximo 2MB. Se recomienda subir imágenes en formato JPG. ";
                $uploadOk = false;
            }

            // Permitir formatos
            if ($extension_archivo_subido != "jpg" && $extension_archivo_subido != "png" &&
                    $extension_archivo_subido != "jpeg" && $extension_archivo_subido != "gif") {
                echo "Formatos admitidos: JPG, JPEG, PNG y GIF. ";
                $uploadOk = false;
            }
//            
            // Comprobación final
            if (!$uploadOk) {
                echo "El fichero no pudo subirse.";
                
            } else {
                // Crear carpeta con el nombre del 
                if (!file_exists($directorio_destino)) {
                    mkdir($directorio_destino, 0777);
                }

                // MOVER LA IMAGEN A SU SITIO FINAL
                if (move_uploaded_file($_FILES["archivo_a_subir"]["tmp_name"], $ruta_destino_imagen_ext_original)) {

                    // TRANSFORMAR LA IMAGEN A  .jpg DEPENDIENDO DE LA EXTENSION
                    if (strcmp($extension_archivo_subido, 'png') == 0) {  // strcmp, comparacion de strings. 0 es que son iguales
                        $imagen_en_jpg = imagecreatefrompng($ruta_destino_imagen_ext_original);
                    } else if (strcmp($extension_archivo_subido, 'gif') == 0) {
                        $imagen_en_jpg = imagecreatefromgif($ruta_destino_imagen_ext_original);
                    } else if (strcmp($extension_archivo_subido, 'jpeg') == 0 || strcmp($extension_archivo_subido, 'jpg') == 0) {
                        $imagen_en_jpg = imagecreatefromjpeg($ruta_destino_imagen_ext_original);
                    }

                    // GUARDAR LA IMAGEN
                    imagejpeg($imagen_en_jpg, $ruta_destino_imagen_final, 70);  // 80 la calidad
                    unlink($ruta_destino_imagen_ext_original); // borrar fichero del que convertimos a jpg
                    // SI LA RESOLUCIÓN ES MUY GRANDE, REDUCIRLA Y SOBREESCRIBIR LA IMAGEN
                    $propiedades = getimagesize($ruta_destino_imagen_final);
                    $ancho_original = $propiedades[0];
                    $alto_original = $propiedades[1];

                    if ($ancho_original > 1200 || $alto_original > 1200) {
                        $ratio_original = $ancho_original / $alto_original;
                        $ancho = 1200;
                        $alto = 1200;

                        if ($ancho / $alto > $ratio_original) {
                            $ancho = $alto * $ratio_original;
                        } else {
                            $alto = $ancho / $ratio_original;
                        }

                        // "Marco" nuevo donde se meterá la imagen,
                        $contendor = imagecreatetruecolor($ancho, $alto);
                        $origen = imagecreatefromjpeg($ruta_destino_imagen_final);

                        // Contenedor o marco, original, coordenadas, ancho y alto nuevos, ancho y alto originales. 
                        imagecopyresampled($contendor, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho_original, $alto_original);
                        imagejpeg($contendor, $directorio_destino . '/' . $idVenta . '.jpg', 100);  // 100 la calidad
                    }


                    // CREAR MINIATURA A PARTIR DE LA IMAGEN GUARDADA ANTERIORMENTE                     
                    $propiedades = getimagesize($ruta_destino_imagen_final);
                    $ancho_original = $propiedades[0];
                    $alto_original = $propiedades[1];

                    // Mantener en la miniatura el ratio de la imagen original. La miniatura podrá ser
                    // como mucho de 300px de alto o 300px de alto.
                    $ratio_original = $ancho_original / $alto_original;
                    $ancho = 300;
                    $alto = 300;

                    if ($ancho / $alto > $ratio_original) {
                        $ancho = $alto * $ratio_original;
                    } else {
                        $alto = $ancho / $ratio_original;
                    }

                    // "Marco" nuevo donde se meterá la imagen,
                    $contendor = imagecreatetruecolor($ancho, $alto);
                    $origen = imagecreatefromjpeg($ruta_destino_imagen_final);

                    // Contenedor o marco, original, coordenadas, ancho y alto nuevos, ancho y alto originales. 
                    imagecopyresampled($contendor, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho_original, $alto_original);
                    imagejpeg($contendor, $directorio_destino . '/' . $idVenta . '_mini.jpg', 100);  // 100 la calidad

                    echo "El fichero " . basename($_FILES["archivo_a_subir"]["name"]) . " ha sido subido.";
                } else {
                    echo "Lo siento, hubo un error subiendo el fichero.";
                }
            }
        }
        ?>

    </body>
</html>

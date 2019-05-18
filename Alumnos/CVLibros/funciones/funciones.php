<?php

function filtrado($datos) {
    $datos = trim($datos);
    $datos = stripslashes($datos);
    $datos = htmlspecialchars($datos);
    return $datos;
}

function validarPass($pass) {
    $correcto = false;

    // Que tenga como mínimo una mayúscula, una minúsculay y un número, en cualquier posición.
    // Y como mínimo, 5 caracteres y máximo 20.
    $plantilla = '/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{5,20}/';

    if (preg_match($plantilla, $pass)) {
        $correcto = true;
    }

    return $correcto;
}

function subir_imagen($idAnuncio) {
    $uploadOk = true;

    if (@$_FILES['archivo_a_subir']['name']) {
        $nombre_archivo_subido = strtolower($_FILES['archivo_a_subir']['name']); // por si la extension estuviera en mayúscula
        $extension_archivo_subido = explode('.', $nombre_archivo_subido)[1]; // explode, como el split de javascript 

        $directorio_destino = 'fotos/' . $idAnuncio;
        $ruta_destino_imagen_final = $directorio_destino . '/' . $idAnuncio . '.jpg';
        $ruta_destino_imagen_ext_original = $directorio_destino . '/' . $extension_archivo_subido;

        //**********************************************************************************************

        // Comprobar tamaño del fichero. Si se pasa de 2MB, se guarda el tamaño como 0
        if ($_FILES['archivo_a_subir']['size'] > 2097152 || $_FILES['archivo_a_subir']['size'] == 0) {
            $_SESSION['MENS_FOTO_alu_com'] = "Imagen demasiado pesada. Máximo 2MB. Se recomienda subir imágenes en formato JPG.";
            $uploadOk = false;
        } else {
            // Permitir formatos
            if ($extension_archivo_subido != "jpg" && $extension_archivo_subido != "png" &&
                    $extension_archivo_subido != "jpeg" && $extension_archivo_subido != "gif" && $extension_archivo_subido != "bmp") {
                $_SESSION['MENS_FOTO_alu_com'] = "Debes subir en uno de los siguientes formatos: JPG, JPEG, PNG, BMP o GIF.";
//            echo "Formatos admitidos: JPG, JPEG, PNG y GIF. ";
                $uploadOk = false;
            }
        }

        // Comprobación final
        if ($uploadOk) {
            // Crear carpeta con el id del anuncio. Necesaria para pasos posteriores.
            if (!file_exists($directorio_destino)) {
                mkdir($directorio_destino, 0777);
            }

            // MOVER LA IMAGEN A SU SITIO FINAL
            if (move_uploaded_file($_FILES["archivo_a_subir"]["tmp_name"], $ruta_destino_imagen_ext_original)) {

                // TRANSFORMAR LA IMAGEN A  .jpg DEPENDIENDO DE LA EXTENSION
                if (strcmp($extension_archivo_subido, 'png') == 0) {  // strcmp, comparacion de strings. 0 es que son iguales
                    @$imagen_en_jpg = imagecreatefrompng($ruta_destino_imagen_ext_original);
                } else if (strcmp($extension_archivo_subido, 'bmp') == 0) {
                    @$imagen_en_jpg = imagecreatefrombmp($ruta_destino_imagen_ext_original);
                } else if (strcmp($extension_archivo_subido, 'gif') == 0) {
                    @$imagen_en_jpg = imagecreatefromgif($ruta_destino_imagen_ext_original);
                } else if (strcmp($extension_archivo_subido, 'jpeg') == 0 || strcmp($extension_archivo_subido, 'jpg') == 0) {
                    @$imagen_en_jpg = imagecreatefromjpeg($ruta_destino_imagen_ext_original);
                }

                // Si el formaot o propiedad de la imagen da problema, borrar la carpeta
                if (!is_resource($imagen_en_jpg)) {
                    $uploadOk = false;
                     unlink($directorio_destino . '/' . $extension_archivo_subido);  // borraa el fichero
                     rmdir($directorio_destino);            // borra la carpeta
                }

                if ($uploadOk) {  
                    // GUARDAR LA IMAGEN
                    imagejpeg($imagen_en_jpg, $ruta_destino_imagen_final, 60);  // el número, la calidad
                    unlink($ruta_destino_imagen_ext_original); // borrar fichero del que convertimos a jpg
                    // SI LA RESOLUCIÓN ES MUY GRANDE, REDUCIRLA Y SOBREESCRIBIR LA IMAGEN
                    $propiedades = getimagesize($ruta_destino_imagen_final);
                    $ancho_original = $propiedades[0];
                    $alto_original = $propiedades[1];

                    if ($ancho_original > 900 || $alto_original > 900) {
                        $ratio_original = $ancho_original / $alto_original;
                        $ancho = 900;
                        $alto = 900;

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
                        imagejpeg($contendor, $directorio_destino . '/' . $idAnuncio . '.jpg', 80);  // 100 la calidad
                    }

                    // CREAR MINIATURA A PARTIR DE LA IMAGEN GUARDADA ANTERIORMENTE                     
                    $propiedades = getimagesize($ruta_destino_imagen_final);
                    $ancho_original = $propiedades[0];
                    $alto_original = $propiedades[1];

                    // Mantener en la miniatura el ratio de la imagen original. La miniatura podrá ser
                    // como mucho de 300px de alto o 300px de alto.
                    $ratio_original = $ancho_original / $alto_original;
                    $ancho = 250;
                    $alto = 250;

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
                    imagejpeg($contendor, $directorio_destino . '/' . $idAnuncio . '_mini.jpg', 70);  // 100 la calidad

                    $_SESSION['MENS_FOTO_alu_com'] = "El fichero " . basename($_FILES["archivo_a_subir"]["name"]) . " ha sido subido.";
                    
                } else {
                    $_SESSION['MENS_FOTO_alu_com'] = "Las características de la imagen provocaron un error. <br> Abre la imagen con un editor de imágenes, guárdala en otro fichero y vuelve a intentarlo.";
                }
                
            } else {
                $_SESSION['MENS_FOTO_alu_com'] = "Lo siento, hubo un error subiendo el fichero.";
            }
        }
    }

    return $uploadOk;
}

/* El directorio se llama igual que la ID del anuncio */
function borrarImagenes($idAnuncio, $desde = 'index') {
    if ($desde == 'index') {
        $dir = 'Alumnos/CVLibros/fotos/' . $idAnuncio;
    } else {
        $dir = 'fotos/' . $idAnuncio;
    }

    if (is_dir($dir)) {
        $objetos = scandir($dir);

        // Borrar primero el contenido
        foreach ($objetos as $objeto) {
            if ($objeto != "." && $objeto != "..") {
                if (filetype($dir . "/" . $objeto) == "dir")
                    rrmdir($dir . "/" . $objeto);
                else
                    unlink($dir . "/" . $objeto);
            }
        }
        rmdir($dir); // Borrar la carpeta
    }
}

/* Porque en la tabla no se guardan los saltos de línea */
function pon_br_a_saltos_de_linea($str) {
    return str_replace(array("\r\n", "\r", "\n"), "<br>", $str);
}

/* Para las vistas */
function quita_br_a_saltos_de_linea($str) {
    return str_replace("<br>", "\r\n", $str);
}

/* Formar una palabra extrayendo 50 veces aleatoriamente elementos del array y
 * concatenándolos en un string. Después crear un hash a partir de esa palabra
 * y extraer de él 30 caracteres, los cuales se utilizarán como ID del anuncio. */

function crearID_anuncio_random() {
    $caracteres = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
        'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1',
        '2', '3', '4', '5', '6', '7', '8', '9'];

    $palabra = '';

    for ($i = 0; $i < 50; $i++) {
        $indice_aleatorio = array_rand($caracteres);
        $palabra .= $caracteres[$indice_aleatorio];
    }

    $hash = hash('sha512', $palabra);  // Crear hash a partir de la palabra y coger un trozo

    return substr($hash, 10, 30); // Desde el caracter 10, coger 30 caracteres.
}

/* Función para comprobar que las id tienen prácticamente ninguna posibilidad de repetirse
 * Para crear IDs utilizando la función anterior y cada una la compara con las anteriores.
 * En 2 pruebas creando 20.000 ids, y en 6 pruebas creando 40.000, no se ha repetido ni una */

function test_ids_creadas($num_claves) {
    $array = [];

    for ($i = 0; $i < $num_claves; $i++) {
        $id = crearID_anuncio_random();

        // Comparar la id con todas las guardadas
        for ($j = 0; $j < count($array); $j++) {
            if (strcmp($id, $array[$j]) == 0) {
                echo 'Coincidencia <br>';
            }
        }

        array_push($array, $id);
    }

    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>
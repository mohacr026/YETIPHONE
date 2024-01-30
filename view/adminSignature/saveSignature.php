<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la imagen en formato base64
    $imagenBase64 = $_POST["imagen"];

    // Decodificar la imagen base64
    $imagen = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imagenBase64));

    // Ruta donde se guardará la imagen en el servidor
    $rutaDestino = '../../src/img/signatures/';

    // Nombre de archivo único para evitar conflictos
    $nombreArchivo = 'adminSignature.png';

    // Ruta completa del archivo en el servidor
    $rutaCompleta = $rutaDestino . $nombreArchivo;

    // Guardar la imagen en el servidor
    file_put_contents($rutaCompleta, $imagen);
} else {
    echo "Error: Método no permitido";
}

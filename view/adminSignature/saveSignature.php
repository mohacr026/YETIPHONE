<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gets the image in base 64bit format
    $baseImage = $_POST["image"];

    // Decodes the base image
    $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseImage));

    // Server route (relative to this file)
    $serverPath = '../../src/img/signatures/';
    
    $fileName = 'adminSignature.png';
    $rutaCompleta = $serverPath . $fileName;

    file_put_contents($rutaCompleta, $image);
} else {
    echo "Method error";
}

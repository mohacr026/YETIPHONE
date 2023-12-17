<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="./src/js/userMenu.js"></script>
    <script src="./src/js/slider.js"></script>
</head>

<body>
    <?php
    include("./view/components/header.php");
    ?>
    <main>
        <div class="slider-container">
            <div class="slider-principal" ontouchstart="handleTouchStart(event)" ontouchmove="handleTouchMove(event)">
                <div class="slider">
                    <img src="./src/img/hola.png" alt="Slide 1">
                    <img src="./src/img/hola.png" alt="Slide 2">
                    <img src="./src/img/hola.png" alt="Slide 3">
                </div>
            <div class="slider-controls">
                <button class="prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
                <button class="next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
            </div>
                <div class="slider-indicators">
                    <div class="indicator"></div>
                    <div class="indicator"></div>
                    <div class="indicator"></div>
                </div>
            </div>

            <div class="slider-destacados">
                <!-- Contenido del slider-destacados -->
            </div>
        </div>
    </main>

</body>
</html>

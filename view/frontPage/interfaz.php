<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .slider-principal {
            position: relative;
            width: 80%;
            max-width: 800px;
            margin: auto;
            overflow: hidden;
            height: 100%;
        }

        .slider {
            margin-top: 0.5em;
            display: flex;
            transition: transform 0.5s ease-in-out;
            touch-action: pan-y;
        }

        .slider img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider-controls {
            position: absolute;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
        }

        .slider-controls button {
            border: none;
            background: none;
            color: white;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .slider-indicators {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .indicator {
            width: 45px;
            height: 10px;
            border-radius: 30%;
            background: rgba(78, 184, 221, 1); /* Color de fondo de las líneas inactivas */
        }

        .indicator.active {
            background: rgba(33, 112, 147, 1); /* Color de fondo de la línea activa */
        }
    </style>
    <script src="./src/js/userMenu.js"></script>
    <script>
        let slideIndex = 0;
        let touchStartX = 0;

        function handleTouchStart(event) {
            touchStartX = event.touches[0].clientX;
        }

        function handleTouchMove(event) {
            const touchEndX = event.touches[0].clientX;
            const deltaX = touchStartX - touchEndX;

            if (Math.abs(deltaX) > 30) {
                if (deltaX > 0) {
                    changeSlide(1); // Deslizar hacia la izquierda
                } else {
                    changeSlide(-1); // Deslizar hacia la derecha
                }
            }
        }

        function showSlide(index) {
            const slides = document.querySelector('.slider');
            const totalSlides = document.querySelectorAll('.slider img').length;

            slideIndex = (index + totalSlides) % totalSlides;

            slides.style.transform = `translateX(${-slideIndex * 100}%)`;

            // Actualizar el estado de las líneas indicadoras
            const indicators = document.querySelectorAll('.indicator');
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('active', i === slideIndex);
            });
        }

        function changeSlide(n) {
            showSlide(slideIndex += n);
        }

        // Autoplay (opcional)
        setInterval(() => {
            changeSlide(1);
        }, 3000);
    </script>
</head>

<body>
    <?php
    include("./view/components/header.php");
    ?>
    <main>
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
                <!-- Líneas indicadoras -->
                <div class="indicator"></div>
                <div class="indicator"></div>
                <div class="indicator"></div>
            </div>
        </div>
    </main>
</body>
</html>

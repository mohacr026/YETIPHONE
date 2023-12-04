<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
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
            height: 100%; /* Ajuste de altura */
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            touch-action: pan-y;
        }

        .slider img {
            width: 100%; /* Ajuste del ancho */
            height: 100%; /* Ajuste de la altura */
            object-fit: cover; /* Para mantener la relación de aspecto y cubrir el espacio */
        }

        button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: #3498db;
            color: white;
            padding: 10px;
            cursor: pointer;
        }

        .prev {
            left: 0;
        }

        .next {
            right: 0;
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
        <button class="prev" onclick="changeSlide(-1)">Previous</button>
        <button class="next" onclick="changeSlide(1)">Next</button>
    </div>

    </main>
</body>
</html>

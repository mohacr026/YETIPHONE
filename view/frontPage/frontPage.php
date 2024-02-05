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
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="./scr/js/searchBar.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script src="./src/js/slider.js"></script>
    <script id="productJSON" type="application/json"> <?php echo "$productsJsonResult"; ?> </script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
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
                <div class="destacados-container">
                    <?php foreach ($products as $product): ?>
                        <div class="product">
                            <p><?php echo $product['name']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="slider-categories">
                <div class="categories-container">
                    <?php foreach ($categories as $category): ?>
                        <div class="categories">
                            <p><?php echo $category['name']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="slider-controls">
                <button class="prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
                <button class="next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
            </div>
            </div>
        </div>
    </main>

</body>
</html>

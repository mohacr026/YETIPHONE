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

<style>
    .products-container {
        display: flex; /* Establece el contenedor de productos como un contenedor de tipo flex */
        padding: 10px; /* Agrega un relleno para espaciar los productos del borde del contenedor */
    }

    .product {
        background-color: #3498db; /* Color azulado de fondo */
        margin-right: 20px; /* Agrega un margen derecho para espaciar los productos horizontalmente */
        padding: 10px; /* Agrega relleno dentro de cada producto */
        width: 360px;
        height: 90px;
        /* transform: rotate(-90deg); */
        flex-shrink: 0;
        border-radius: 20px;
        background: var(--DarkBlue, #217093);
        box-shadow: 0px 4px 10px 4px rgba(0, 0, 0, 0.25);
        color: white;
    }

    .topProducts {
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 3em;
        width: 182px;
        height: 50px;
        flex-shrink: 0;
        background: #4EB8DD;
        color: white;
        margin-top: -25px; /* Ajusta este valor según tus necesidades */
        margin-left: 35px;
        z-index: 10; /* Asegura que topProducts esté por encima de slider-destacados */
    }

    .hidden {
        display: none;
    }

    .products-slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }
</style>

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
                <div class="topProducts">
                    <p>TOP PRODUCTS</p>
                </div>
                <div class="topSale">
                    <p>TOP SALE</p>
                </div>

                <div class="products-container">
                    <div class="products-slider">
                        <?php $count = 0; ?>
                        <?php foreach ($products as $product): ?>
                            <?php if ($count < 3): ?>
                                <div class="product">
                                    <p><?php echo $product->getName(); ?></p>
                                    <p><?php echo $product->getId(); ?></p>

                                </div>
                            <?php endif; ?>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Agrega botones de control del slider -->
                <button class="prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
                <button class="next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
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

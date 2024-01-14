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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script src="./src/js/slider.js"></script>
    <script type="module" src="./src/js/searchBar.js"></script>
</head>

<style>
    .products-container {
        display: flex; /* Establece el contenedor de productos como un contenedor de tipo flex */
        padding: 10px; /* Agrega un relleno para espaciar los productos del borde del contenedor */
        margin-top: 115px;
    }

    .products-container-2 {
        display: flex; /* Establece el contenedor de productos como un contenedor de tipo flex */
        padding: 10px; /* Agrega un relleno para espaciar los productos del borde del contenedor */
    }

    .product {
        background-color: #3498db; /* Color azulado de fondo */
        margin-right: 20px; /* Agrega un margen derecho para espaciar los productos horizontalmente */
        padding: 10px; /* Agrega relleno dentro de cada producto */
        width: 355px;
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
        background: rgba(78, 184, 221, 1);
        margin-top: -25px; /* Ajusta este valor según tus necesidades */
        margin-left: 35px;
        z-index: 10; /* Asegura que topProducts esté por encima de slider-destacados */
        color: #FFF;
        text-align: center;
        font-family: Inter;
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    .topSale {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 240px;
        margin-top: -120px;
        width: 107px;
        height: 23px;
        flex-direction: column;
        justify-content: center;
        flex-shrink: 0;
        background: rgba(211, 74, 74, 1);
        border-radius: 3em;
        z-index: 10; /* Asegura que topProducts esté por encima de slider-destacados */
        color: #FFF;
        text-align: center;
        font-family: Inter;
        font-size: 16px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    .Tops {
        display: flex;
        justify-content: space-between; /* Distribuye los elementos con espacio entre ellos */
        align-items: center; /* Centra los elementos verticalmente */
    }

    .Tops2 {
        display: flex;
        justify-content: space-between; /* Distribuye los elementos con espacio entre ellos */
        align-items: center; /* Centra los elementos verticalmente */
    }

    .hidden {
        display: none;
    }

    .products-slider {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .price {
        display: flex;
        justify-content: center;
        align-items: center;
        background: none;
        border-radius: 3em;
        width: 75px;
        color: #FFF;
        font-family: Inter;
        font-size: 24px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        margin-left: 175px;
    }

    .name {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 65px;
        color: #FFF;
        font-family: Inter;
        font-size:15px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        margin-top: 6px;
    }

    footer {
        display: flex;
        width:100%;
        height: 275px;
        flex-shrink: 0;
        background: var(--MediumBlue, #4EB8DD);
        margin-top: 3em;
    }

    .columna {
        display: flex;
        justify-content: center;
        align-items: center;
        flex: 1;
        padding: 10px;
        flex-direction: column;
        color: white;
        font-weight: 700;
        font-size: 16px;
    }

    .columna h2 {
        color: #FFF;
        font-family: Source Sans Pro;
        font-size: 24px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
    }

    .redes{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .redes svg {
        margin: 5px;
    }

    .columna h2 {
        margin-bottom: 10px;
    }

    .columna p {
        margin: 0;
    }

    .logo {
        max-width: 100%;
        height: auto;
    }

    .tops-controls{
        position: absolute;
        margin-right: 155px;
        bottom: -149px;
        right: 20px;
        display: flex;
        gap: 10px;
    }

    .tops-controls button {
        border: none;
        color: white;
        background: none;
        padding: 10px;
        cursor: pointer;
        font-size: 16px;
    }

    .slider-products{
        margin-top: 20px;
        display: block;
        border-radius: 25px;
        background: var(--LightBlue, #bed2db);
        width: 80%; /* Ajusta el ancho según tus necesidades */
        max-width: 1596px;
        height: auto;
        margin: auto; /* Centra el slider-destacados en la página */
        flex-shrink: 0;
        margin-bottom: 20px; /* Espacio entre los dos sliders */
    }

    .box-product {
        background-color: #3498db; /* Color azulado de fondo */
        margin-right: 20px; /* Agrega un margen derecho para espaciar los productos horizontalmente */
        padding: 10px; /* Agrega relleno dentro de cada producto */
        width: max-content;
        height: 200px;
        flex-shrink: 0;
        border-radius: 20px;
        background: var(--DarkBlue, #217093);
        box-shadow: 0px 4px 10px 4px rgba(0, 0, 0, 0.25);
        color: white;
    }

    .productImg {
        display: flex;
        margin-top: -190px;
    }
    
    .productImg img {
        display: flex;
        margin-right: -300px;
        margin-top: 75px;
        width: 248px;
        height: 177px;
        z-index: 1;
        margin-left: -20px;
    }

    .products-normal {
        display: flex;
        background: #00344b;
        width: 251px;
        height: 310px;
        border-radius: 10px;
        padding: 10px;
        margin: 10px;
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
                <div class="Tops">
                    <div class="topProducts">
                        <p>TOP PRODUCTS</p>
                    </div>
                </div>

                <div class="products-container">
                    <div class="products-slider">
                        <?php $count = 0; ?>
                        <?php foreach ($products as $product): ?>
                            <?php if ($count < 3): ?>
                                <div class="productImg">
                                        <img src="./src/img/iphone12.png" alt="iphone 12">
                                    </div>
                                <div class="product">
                                    <div class="name">
                                        <p><?php echo $product->getName(); ?></p>
                                    </div>
                                    <div class="price">
                                        <p><?php echo $product->getPrice(); ?> €</p>
                                    </div>

                                    <div class="Tops2">
                                        <div class="topSale">
                                            <p>TOP SALE</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                    <div class="tops-controls">
                    <button class="prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
                    <button class="next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
<!-- 
            <div class="slider-categories">
                <div class="categories-container">
                    <?php #foreach ($categories as $category): ?>
                        <div class="categories">
                            <p><?php# echo $category['name']; ?></p>
                        </div>
                    <?php# endforeach; ?>
                </div>
                <div class="slider-controls">
                <button class="prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
                <button class="next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
            </div>
            </div> -->

            <div class="slider-products">
                <div class="Tops">
                    <div class="topProducts">
                        <p>PRODUCTS</p>
                    </div>
                </div>

                <div class="products-container-2">
                    <div class="products-slider">
                        <div class="products-normal">

                        </div>

                        <div class="products-normal">

                        </div>
                        
                        <div class="products-normal">

                        </div>
                        
                        <div class="products-normal">

                        </div>
                    </div>
                    
                </div>
                    <div class="tops-controls">
                    <button class="prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
                    <button class="next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            
        </div>
    </main>

    <footer>
        <div class="columna">
            <div>
                <img src="./src/img/yeti.png" alt="Logo" class="logo" width="200px">
            </div>
        </div>

        <div class="columna">
            <h2>About us</h2>
            <p>Contact</p>
            <p>Help</p>
            <p>Home</p>
        </div>

        <div class="columna">
            <h2>Social media</h2>
            <div class="redes">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
            <g clip-path="url(#clip0_411_68)">
                <path d="M30 15.1824C30 22.7142 24.5075 28.9582 17.3375 30.0912V19.574H20.8237L21.4875 15.2227H17.3375V12.3994C17.3375 11.2084 17.9175 10.0489 19.775 10.0489H21.6613V6.34403C21.6613 6.34403 19.9487 6.04975 18.3125 6.04975C14.895 6.04975 12.6625 8.13359 12.6625 11.9051V15.2214H8.86375V19.5727H12.6625V30.09C5.49375 28.9556 0 22.7129 0 15.1824C0 6.84832 6.71625 0.0912476 15 0.0912476C23.2838 0.0912476 30 6.84706 30 15.1824Z" fill="white"/>
            </g>
            <defs>
                <clipPath id="clip0_411_68">
                <rect width="30" height="30" fill="white"/>
                </clipPath>
            </defs>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
            <g clip-path="url(#clip0_411_76)">
                <path d="M15 2.7025C19.005 2.7025 19.48 2.7175 21.0613 2.79C22.6963 2.865 24.38 3.2375 25.5713 4.42875C26.7738 5.63125 27.135 7.29875 27.21 8.93875C27.2825 10.52 27.2975 10.995 27.2975 15C27.2975 19.005 27.2825 19.48 27.21 21.0613C27.1362 22.6875 26.755 24.3875 25.5713 25.5713C24.3688 26.7738 22.7025 27.135 21.0613 27.21C19.48 27.2825 19.005 27.2975 15 27.2975C10.995 27.2975 10.52 27.2825 8.93875 27.21C7.325 27.1362 5.6025 26.7463 4.42875 25.5713C3.2325 24.375 2.865 22.6913 2.79 21.0613C2.7175 19.48 2.7025 19.005 2.7025 15C2.7025 10.995 2.7175 10.52 2.79 8.93875C2.86375 7.31875 3.24875 5.60875 4.42875 4.42875C5.62875 3.22875 7.3025 2.865 8.93875 2.79C10.52 2.7175 10.995 2.7025 15 2.7025ZM15 0C10.9262 0 10.415 0.0175 8.815 0.09C6.49625 0.19625 4.19375 0.84125 2.5175 2.5175C0.835 4.2 0.19625 6.4975 0.09 8.815C0.0175 10.415 0 10.9262 0 15C0 19.0737 0.0175 19.585 0.09 21.185C0.19625 23.5012 0.84375 25.81 2.5175 27.4825C4.19875 29.1637 6.5 29.8037 8.815 29.91C10.415 29.9825 10.9262 30 15 30C19.0737 30 19.585 29.9825 21.185 29.91C23.5025 29.8037 25.8075 29.1575 27.4825 27.4825C29.1663 25.7987 29.8037 23.5025 29.91 21.185C29.9825 19.585 30 19.0737 30 15C30 10.9262 29.9825 10.415 29.91 8.815C29.8037 6.49625 29.1575 4.1925 27.4825 2.5175C25.8037 0.83875 23.4963 0.195 21.185 0.09C19.585 0.0175 19.0737 0 15 0Z" fill="white"/>
                <path d="M15 7.29749C10.7462 7.29749 7.29749 10.7462 7.29749 15C7.29749 19.2537 10.7462 22.7025 15 22.7025C19.2537 22.7025 22.7025 19.2537 22.7025 15C22.7025 10.7462 19.2537 7.29749 15 7.29749ZM15 20C12.2387 20 9.99999 17.7612 9.99999 15C9.99999 12.2387 12.2387 9.99999 15 9.99999C17.7612 9.99999 20 12.2387 20 15C20 17.7612 17.7612 20 15 20Z" fill="white"/>
                <path d="M23.0075 8.7925C24.0016 8.7925 24.8075 7.98662 24.8075 6.9925C24.8075 5.99839 24.0016 5.1925 23.0075 5.1925C22.0134 5.1925 21.2075 5.99839 21.2075 6.9925C21.2075 7.98662 22.0134 8.7925 23.0075 8.7925Z" fill="white"/>
            </g>
            <defs>
                <clipPath id="clip0_411_76">
                <rect width="30" height="30" fill="white"/>
                </clipPath>
            </defs>
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
            <g clip-path="url(#clip0_411_71)">
                <path d="M15.0125 0C6.73499 0 0.0249939 6.71 0.0249939 14.9875C0.0249939 21.34 3.97249 26.7675 9.54749 28.9512C9.41124 27.7675 9.30124 25.9412 9.59624 24.6462C9.86749 23.4737 11.3475 17.195 11.3475 17.195C11.3475 17.195 10.9037 16.295 10.9037 14.975C10.9037 12.89 12.1125 11.3363 13.6175 11.3363C14.9 11.3363 15.5175 12.2987 15.5175 13.4462C15.5175 14.7288 14.7037 16.6537 14.2712 18.4425C13.9137 19.935 15.0237 21.1562 16.4912 21.1562C19.1562 21.1562 21.2037 18.3438 21.2037 14.2975C21.2037 10.7075 18.6262 8.20375 14.9375 8.20375C10.67 8.20375 8.16499 11.3988 8.16499 14.705C8.16499 15.9875 8.65874 17.37 9.27499 18.1225C9.39999 18.2687 9.41249 18.405 9.37499 18.5525C9.26374 19.0212 9.00499 20.045 8.95499 20.255C8.89374 20.5263 8.73249 20.5875 8.44874 20.4525C6.57374 19.5763 5.40124 16.85 5.40124 14.6425C5.40124 9.9175 8.82999 5.57625 15.3062 5.57625C20.5 5.57625 24.545 9.2775 24.545 14.2362C24.545 19.405 21.2887 23.5625 16.7737 23.5625C15.2562 23.5625 13.825 22.7725 13.345 21.835C13.345 21.835 12.5925 24.6962 12.4075 25.4C12.075 26.7075 11.1612 28.3363 10.545 29.335C11.9525 29.765 13.4337 30 14.9875 30C23.265 30 29.975 23.29 29.975 15.0125C30 6.71 23.29 0 15.0125 0Z" fill="white"/>
            </g>
            <defs>
                <clipPath id="clip0_411_71">
                <rect width="30" height="30" fill="white"/>
                </clipPath>
            </defs>
            </svg>
            
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
            <g clip-path="url(#clip0_411_74)">
                <path d="M28.0813 12.3325C25.4075 12.3325 22.9288 11.4775 20.9063 10.025V20.5063C20.9063 25.7413 16.6475 29.9988 11.4138 29.9988C9.39126 29.9988 7.51501 29.3613 5.97376 28.2788C3.52626 26.56 1.92126 23.7175 1.92126 20.5063C1.92126 15.2713 6.18001 11.0125 11.415 11.0125C11.85 11.0125 12.275 11.0488 12.6938 11.105V12.3263V16.37C12.2888 16.2438 11.8613 16.17 11.415 16.17C9.02501 16.17 7.08001 18.115 7.08001 20.5063C7.08001 22.1713 8.02502 23.6175 9.40501 24.3438C10.0063 24.66 10.69 24.8413 11.4163 24.8413C13.7513 24.8413 15.6563 22.9838 15.7438 20.6688L15.7475 0H20.905C20.905 0.4475 20.9488 0.88375 21.0263 1.30875C21.39 3.27375 22.5563 4.96 24.1725 6.01375C25.2975 6.7475 26.64 7.17625 28.08 7.17625L28.0813 12.3325Z" fill="white"/>
            </g>
            <defs>
                <clipPath id="clip0_411_74">
                <rect width="30" height="30" fill="white"/>
                </clipPath>
            </defs>
            </svg>
            </div>

        </div>
    </footer>
</body>
</html>

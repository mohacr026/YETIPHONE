<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="css/aside.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script src="./src/js/canvas/canvasController.js"></script>
    <script type="module" src="./src/js/searchBar.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
</head>
<body>
    <?php include('./view/components/header.php'); 
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {
    ?>
    <main id="main-admin">
        <?php include("./view/components/adminAside.php"); ?>
        <canvas id="mainCanvas" width="500" height="500" style="background-color:#FFF" tabindex="<?php echo $tabindex++; ?>"></canvas>
        <button id="drawMode" tabindex="<?php echo $tabindex++; ?>">Draw mode</button>
        <button id="eraseMode" tabindex="<?php echo $tabindex++; ?>">Erase mode</button>
        <button id="saveButton" tabindex="<?php echo $tabindex++; ?>">Save</button>
    </main>
    <?php } ?>
</body>
</html>
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
</head>
<body>
    <?php include('./view/components/header.php'); 
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {
    ?>
    <main>
        <?php include("./view/components/adminAside.html"); ?>
        <canvas id="mainCanvas" width="800" height="800" style="background-color:#FFF"></canvas>
        <button id="drawMode">Draw mode</button>
        <button id="eraseMode">Erase mode</button>
        <button id="saveButton">Save</button>
    </main>
    <?php } ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/aside.css">

    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="./src/js/userMenu.js"></script>
</head>
<body>
    <?php
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    include("./view/components/header.php");
    ?>
    <main>
        <aside>
            <h2>Navigation / Preferences</h2>
            <a href="index.php?controller=Product&action=showAddProducts">Add Products</a>
            <a href="index.php?controller=Product&action=showEditProducts">Edit Products</a>
            <a href="index.php?controller=Category&action=showAddCategories">Add Category</a>
            <a href="index.php?controller=Category&action=showEditCategories">Edit Category</a>
            <a href="index.php?controller=Product&action=showInterfaz">User Interface</a>
            <a href="index.php?controller=Purchase&action=showPurchases">Purchases</a>
        </aside>
    </main>
    <?php
        }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="css/aside.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="./src/js/userMenu.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
</head>
<body>
    <?php include('./view/components/header.php'); 
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    ?>
    <main>
        <?php include("./view/components/adminAside.html"); ?>
        <div class="purchaseContainer">
            <form method="POST" action="index.php?controller=Purchase&action=showPurchases&purchase=<?= urlencode(serialize($purchase)) ?>">
                <input type="hidden" name="id" value="<?= $purchase->getId() ?>">

                <label>Username:</label>
                <span><?= $purchase->getUserId() ?></span>

                <label>Date Order:</label>
                <span><?= $purchase->getDateOrder() ?></span>

                <label>Date of shipment:</label>
                <span><?= $purchase->getDateShipment() ?></span>

                <label for="status">Status:</label>
                <select name="status">
                    <option value="PENDING" <?php if ($purchase->getStatus() === 'PENDING') echo 'selected'; ?>>Pending</option>
                    <option value="SHIPPED" <?php if ($purchase->getStatus() === 'SHIPPED') echo 'selected'; ?>>Shipped</option>
                </select><br>

                <div>
                    <button type="submit">SAVE</button>
                    <a href="index.php?controller=Purchase&action=showPurchases">CANCEL</a>
                </div>
            </form>
            <div>
                <?php foreach($products as $product): ?>
                    <?php try {
                        include("./view/components/productDetailDisplayComponent.php");
                    } catch(Exception $e) {
                        echo "<span>Error</span>";
                    } ?>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <?php
    }
    ?>
</body>
</html>
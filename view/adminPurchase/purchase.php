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
    <div id="destination" data-destination="purchase"></div>
    <?php include('./view/components/header.php'); 
    if(!isset($_SESSION['role']) && $_SESSION['role'] != "admin"){
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?controller=User&action=showLoginForm'>";
    } else {

    ?>
    <main>
        <?php include("./view/components/adminAsideSearch.html"); ?>
        <div class="purchaseFilterContainer">
            <form method="POST" action="index.php?controller=Purchase&action=showPurchases">
                <label for="purchase_id">Purchase ID:</label>
                <input type="text" name="purchase_id" id="purchase_id"> <br>
            
                <label for="user_id">User DNI:</label>
                <input type="text" name="user_id" id="user_id"> <br>

                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="NOSTATE" selected>Any state</option>
                    <option value="PENDING">Pending</option>
                    <option value="SHIPPED">Shipped</option>
                </select> <br>

                <label for="dateOrder">Date Order:</label>
                <input type="date" name="dateOrder" id="dateOrder"> <br>

                <label for="dateShipment">Date Shipment:</label>
                <input type="date" name="dateShipment" id="dateShipment"> <br>

                <button type="submit">Filter Purchases</button>
            </form><br>
            <div class="purchaseTableDisplay">
                <div>
                    <span>Purchase ID</span>
                    <span>User name</span>
                    <span>Purchase date</span>
                    <span>State</span>
                </div>
                <?php foreach($purchases as $purchase): ?>
                    <div>
                        <a href="index.php?controller=Purchase&action=showPurchaseInformation&purchase=<?= urlencode(serialize($purchase)) ?>">
                            <span><?= $purchase->getId() ?></span>
                            <span><?= $purchase->getUserId() ?></span>
                            <span><?= $purchase->getDateOrder() ?></span>
                            <span><?= $purchase->getStatus() ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </table>
        </div>
    <main>
    <?php
    }
    ?>
</body>
</html>
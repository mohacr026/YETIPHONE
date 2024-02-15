<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YETiPhone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="./src/img/snowflake.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="./src/js/userMenu.js"></script>
    <script type="module" src="./src/js/ShoppingCart.js"></script>
</head>
    <body class="flex-row">
        <?php
            include("./view/components/header.php");
        
        ?>
        <!-- Clases temporales, cambiar las clases para aplicar nuevo CSS --> 
        <div class="purchaseFilterContainer">
            <table class="purchaseTableDisplay">
                <tr>
                    <th>Purchase ID</th>
                    <th>Purchase date</th>
                    <th>State</th>
                    <th>Shipment date</th>
                    <th>Purchase details</th>
                    <th>Download bill</th>
                </tr>
            <?php foreach($purchases as $purchase): ?>
                <tr>
                    <td><?= $purchase->getId(); ?></td>
                    <td><?= $purchase->getDateOrder(); ?></td>
                    <td><?= $purchase->getStatus(); ?></td>
                    <td><?php if($purchase->getStatus() === "PENDING") { echo "Waiting for shipment"; } else { echo $purchase->getShipmentDate(); } ?></td>
                    <td><a href="index.php?controller=Purchase&action=userPurchaseDetails&id=<?php echo $purchase->getId() ?>">View details</a></td>
                    <td><a href="index.php?controller=Purchase&action=printPdf&id=<?php echo $purchase->getId() ?>">Download bill</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>
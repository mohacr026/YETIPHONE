<?php 
require './vendor/autoload.php';

ob_clean();

$html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
$content =  '<page>';
$content .= '<h1>'.$data['name'].'</h1><br/><h2>'.$data['direction'].'</h2><br/>';
$content .= '<h3>User data:</h3>';
$content .= '<p>'.$user->getDni().'</p>';
$content .= '<p>'.$user->getEmail().'</p>';
$content .= '<p>'.$user->getName().'</p>';
$content .= '<h3>Products:</h3><br/>';
$totalValue = 0;
foreach($products as $product){
    $content .= '<div>';
    $content .= '<div>'.$product['product_name'].'</div>';
    $content .= '<div>'.$product['count'].' units</div>';
    $content .= '<div>'.$product['price'].'€</div><br>';
    $totalValue += $product['price'];
    $content .= '</div>';
}
$content .= '<p>Total price: '.$totalValue.'€</p>';
$content .= '<page_footer>';
$content .= '<h3>Administrator signature:</h3><br/>';
$content .= '<img src="./src/img/signatures/adminSignature.png" alt="Administrator signature" style="width:200px;height:200px;">';
$content .= '</page_footer></page>';
$html2pdf->writeHTML($content);
$html2pdf->output('purchase-details.pdf');

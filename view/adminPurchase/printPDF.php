<?php 
require './vendor/autoload.php';

$html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
$content =  '<page>';
$content .= '<h1>'.$data['name'].'</h1><br/><h2>'.$data['direction'].'</h2><br/>';
$content .= '<h3>Products:</h3><br/>';
$content .= '<div style="display:flex;flex-direction:row;justify-content:space-between;">';
foreach($products as $product){
    $content .= '<div>'.$product['product_name'].'</div>';
    $content .= '<div>'.$product['count'].'</div><br>';
}
$content .= '</div>';
$content .= '<page_footer>';
$content .= '<h3>Administrator signature:</h3><br/>';
$content .= '<img src="./src/img/signatures/adminSignature.png" alt="Administrator signature" style="width:200px;height:200px;">';
$content .= '</page_footer></page>';
$html2pdf->writeHTML($content);
$html2pdf->output('purchase-details.pdf');

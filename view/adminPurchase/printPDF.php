<?php 
require './vendor/autoload.php';

ob_clean();

$html2pdf = new \Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');

$vueltas = 40;
$content =  '<page>';
$content .= '<h1>Purchase bill</h1>';
$content .= '<table><tr><td>';
$content .= '<h3>Company data';
for($i = 0; $i < $vueltas+($vueltas*0.5); $i++){
    $content .= '&nbsp;';
}
$content .= '</h3>';
$content .= '<table><tr><th>Company name:</th><td>'.$data['name'].'</td></tr>';
$content .= '<tr><th>Company direction:</th><td>'.$data['direction'].'</td></tr>';
$content .= '<tr><th>Contact email:</th><td>'.$data['email'].'</td></tr>';
$content .= '<tr><th>Contact phone:</th><td>'.$data['phone'].'</td></tr>';
$content .= '<tr><th>C.i.f:</th><td>'.$data['cif'].'</td></tr>';
$content .= '</table>';
$content .= '</td><td>';
$content .= '<h3>User data</h3>';
$content .= '<table><tr><th>User name:</th><td>'.$user->getName().' '.$user->getSurname().'</td></tr>';
$content .= '<tr><th>User direction:</th><td>'.$user->getDirection().'</td></tr>';
$content .= '<tr><th>User email:</th><td>'.$user->getEmail().'</td></tr>';
$content .= '<tr><th>User phone:</th><td>'.$user->getPhoneNumber().'</td></tr>';
$content .= '<tr><th>User DNI:</th><td>'.$user->getDni().'</td></tr>';
$content .= '</table>';
$content .= '</td></tr></table>';
$content .= '<h3>Products</h3><br/>';
$content .= '<table><tr><th>Product name';
for($i = 0; $i < $vueltas; $i++){
    $content .= '&nbsp;';
}
$content .= '</th>';
$content .= '<th>Quantity';
for($i = 0; $i < $vueltas; $i++){
    $content .= '&nbsp;';
}
$content .= '</th>';
$content .= '<th>Price';
for($i = 0; $i < $vueltas; $i++){
    $content .= '&nbsp;';
}
$content .= '</th>';
$content .= '<th>Total price';
for($i = 0; $i < $vueltas; $i++){
    $content .= '&nbsp;';
}
$content .= '</th></tr>';
$totalValue = 0;
foreach($products as $product){
    $content .= '<tr>';
    $content .= '<td>'.$product['product_name'].'</td>';
    $content .= '<td>'.$product['count'].' units</td>';
    $content .= '<td>'.$product['price'].'€</td>';
    $content .= '<td>'.$product['price']*$product['count'].'€</td>';
    $totalValue += $product['price'] * $product['count'];
    $content .= '</tr>';
}
$content .= '<tr><td></td><td></td><td>Total price</td><td>'.$totalValue.'€</td></tr></table>';
$content .= '<page_footer>';
$content .= '<p>This website is supervised and administrated by: '.$adminName.'</p>';
$content .= '<h3>Administrator signature:</h3><br/>';
$content .= '<img src="./src/img/signatures/adminSignature.png" alt="Administrator signature" style="width:200px;height:200px;">';
$content .= '</page_footer></page>';
$html2pdf->writeHTML($content);
$html2pdf->output('purchase-details.pdf');

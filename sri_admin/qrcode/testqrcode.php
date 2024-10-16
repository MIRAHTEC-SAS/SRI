<?php
require_once('qrcode.class.php');
$qrcode = new QRcode('https://sedif.sn', 'H'); // error level : L, M, Q, H
$qrcode->displayPNG();
exit;
?>
<?php

    require('html_table.php');
    require('pdf_codabar.php');

    $n=20;
    function getRandomString($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
  
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
  
    return $randomString;
}
    $code_service='43100000';
    $token=getRandomString(20);
    $linkQrcode="https://yaakaarplus.com/administration/verification.php?code_service=".$token;

    require('html_table.php');
    require('pdf_codabar.php');


    $pdf = new myPDF();

    require_once('qrcode/qrcode.class.php');


    // $pdf->SetXY( 153, 240);
    $qrcode = new QRcode($linkQrcode, 'H'); // error level : L, M, Q, H
    // $qrcode->displayPNG();

    $qrcode->displayFPDF($pdf, 10, 266,20);

    $nom_file="qr_code_dtai.pdf";
    $nomRep = $code_service;

    $typeDocument='Qrcode';

    if (is_dir("QRCODES/".$nomRep)) {
        $pdf->Output("F", "QRCODES/".$nomRep."/".$nom_file,true);
    }
    
    else
    {
        mkdir("QRCODES/".$nomRep);
        $pdf->Output("F", "QRCODES/".$nomRep."/".$nom_file,true);
        
    }

    $pdf->Output("I", $nom_file);

    ?>
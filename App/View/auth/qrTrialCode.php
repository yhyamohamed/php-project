<?php
use Endroid\QrCode;
//echo('Hassan');
header('Content-Type: image/png');
require_once("../../../vendor/autoload.php");
$qrCode= new QrCode\QrCode();
$qrCode->setText('https://www.youtube.com');
$qrCode->setSize(100);
$qrCode->setPadding(10);
$qrCode->render();

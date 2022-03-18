<?php
  require_once("../../vendor/autoload.php");
  header('Content-Type: image/png');

  use Endroid\QrCode;
//echo('Hassan');
$qrCode= new QrCode\QrCode();
$qrCode->setText('https://www.youtube.com');
$qrCode->setSize(200);
$qrCode->setPadding(10);
  try {
    $qrCode->render();
  } catch (QrCode\Exceptions\ImageFunctionUnknownException $e) {
  }

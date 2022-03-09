<?php

require_once '../../vendor/autoload.php';
use App\Controllers\USerController;

$u = new USerController;

$user = $u->show('yaya@gmail.com', 123456);

echo "<pre>";
print_r($user);
echo "<pre>";



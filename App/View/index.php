<?php

require_once '../../vendor/autoload.php';
use App\Controllers\UserController;

$u = new UserController;

// $user = $u->show('yaya@gmail.com', 123456);

// $user = $u->index();
// $user = $u->create('yaya1@gmail.com', 123456);
// $user = $u->edit(8,pass:1234567);
$user = $u->destroy(5);

echo "<pre>";
print_r($user);
echo "<pre>";



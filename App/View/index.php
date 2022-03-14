<?php
session_start();
require_once '../../vendor/autoload.php';

use App\Controllers\UserController;
var_dump($_SESSION);
var_dump($_COOKIE);
$u = new UserController;

// $user = $u->show('admin@admin.com', 123456,'on');

// $user = $u->index();
// $user = $u->create('yaya1@gmail.com', 123456);
// $user = $u->edit(8,pass:1234567);
// $user = $u->destroy(5);

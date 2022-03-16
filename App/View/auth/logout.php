<?php

session_start();
require_once("../../../vendor/autoload.php");
use App\Controllers\UserController;

$controller = new UserController();
unset($_SESSION['user_id']);
session_destroy();
$userToken = $_COOKIE['remember_me'];
$controller->logOut($userToken);

header('Location:payment.php');
die;


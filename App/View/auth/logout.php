<?php

session_start();
require_once("../../../vendor/autoload.php");
use App\Controllers\UserController;
use App\Utilities\Helper;
$controller = new UserController();
unset($_SESSION['user_id']);
session_destroy();

if (isset($_COOKIE['remember-me'])) {
  $userToken = $_COOKIE['remember-me'];
  $controller->logOut($userToken);
}
Helper::redirect(BASE_PATH . "/auth/payment.php");

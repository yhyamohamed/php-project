<?php
session_start();
require_once '../../vendor/autoload.php';

use App\Controllers\TokenController;
use App\Controllers\UserController;
use App\Utilities\Helper;

//will be used fore redirection

$tokenController = new TokenController();
$userController = new UserController();
$product_id = 1;
//check for remember me
if (isset($_COOKIE['remember-me']) && !isset($_SESSION['user_id']))
{
    $tokenDetails = $tokenController->checkToken($_COOKIE['remember-me']);
    $_SESSION['user_id'] = $tokenDetails->user_id;
    $userId = $tokenDetails->user_id;
    $userController->loginWithToken($userId);
    Helper::redirect("download.php");
    die();
}
else if (!isset($_COOKIE['remember-me']) && isset($_SESSION['user_id']))
{
    Helper::redirect("download.php");
    die();
}
else if (isset($_COOKIE['remember-me']) && isset($_SESSION['user_id']))
{
    Helper::redirect("download.php");
    die();
}
header("Location:auth/payment.php");
die();

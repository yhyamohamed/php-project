<?php
// echo sha1(990) . "<br>";

session_start();
require_once '../../vendor/autoload.php';

use App\Controllers\OrderController;
use App\Controllers\TokenController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Utilities\Helper;

$tokenController = new TokenController();
$userController = new UserController();
$productController = new ProductController();
$product_id = 1;
$product_name = $productController->showDetails($product_id)->product_name;
$file = "$product_name.txt";

if (isset($_COOKIE['remember-me']) && !isset($_SESSION['user_id']))
{

    $tokenDetails = $tokenController->checkToken($_COOKIE['remember-me']);
    if (isset($_COOKIE['remember-me']) && !isset($tokenDetails))
    {
        Helper::redirect("auth/logout.php");
        die();
    }
    $_SESSION['user_id'] = $tokenDetails->user_id;
    $userId = $tokenDetails->user_id;
    $userController->loginWithToken($userId);
}
else if (!isset($_COOKIE['remember-me']) && !isset($_SESSION['user_id']))
{

    echo "<h2 style='position:absolute; left:10%;  font-size: 150px;'>Access Forbidden</h2>";
    die();
}

if ($_SERVER['REQUEST_METHOD'] === "GET")
{
    if (count($_GET) > 0)
    {
        if (isset($_GET["file"]))
        {
            $filetoken = $_GET["file"];
            $current_token = $productController->showDetails(1)->download_file_link;
            if ($filetoken === $current_token)
            {
                change_token($product_id);
                increment_count();
                header("Content-Description: File Transfer");
                header("Content-Type: application/text");
                $str = "Content-Disposition: attachment; filename=\"" . basename($file) . "\"";
                header($str);
                readfile($file);
                exit();
            }
            else
            {
                echo "1- $filetoken 2- $current_token";
                echo "Invalid Token";
            }
        }
        else
        {
            echo "Missing File token #3";
        }
    }
    else
    {
        echo "Missing File token #2";
    }
}
else
{
    echo "Missing File token #1";
}


function change_token($product_id)
{
    $token = Helper::generateRandomString(10);
    $productController = new ProductController;
    $productController->edit($product_id, null, $token);
}

function increment_count()
{
    $orderController = new OrderController;
    $orderController->incrementDownloadCount($_SESSION["user_id"]);
}

<?php
// echo sha1(990) . "<br>";

session_start();
require_once '../../vendor/autoload.php';

use App\Controllers\ProductController;
use App\Controllers\OrderController;
use App\Utilities\Helper;

$pc = new ProductController;
$file = "product1.txt";

// echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] === "GET")
{
    if (count($_GET) > 0)
    {
        if (isset($_GET["file"]))
        {
            $filetoken = $_GET["file"];
            $current_token = $pc->showDetails(1)->download_file_link;
            // echo "Hi " . $filetoken . " --- " . $current_token;
            if ($filetoken === $current_token)
            {
                change_token();
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


function change_token()
{

    $secret = "AdminSecretKey";
    $hexTime = dechex(time());
    $token = Helper::generateRandomString(10);
    $pc = new ProductController;
    $pc->edit(1, null, $token);
}

function increment_count()
{
    $oc = new OrderController;
    $oc->incrementDownloadCount($_SESSION["user_id"]);
}

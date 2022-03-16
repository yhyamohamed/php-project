<?php

//open session and loading the composer
session_start();
require_once("../../../vendor/autoload.php");

use App\Controllers\OrderController;
use App\Controllers\UserController;
use App\Controllers\TokenController;
//will be used fore redirection
use App\Utilities\Helper;

$token = new TokenController();
$user = new UserController();
$error = '';
$product_id = 1;
//check for remember me
if (isset($_COOKIE['remember-me']) && !isset($_SESSION['user_id']))
{
  $tokenDetails = $token->checkToken($_COOKIE['remember-me']);
  var_dump($tokenDetails->user_id);
  $_SESSION['user_id'] = $tokenDetails->user_id;
  $userId = $tokenDetails->user_id;
  $user->loginWithToken($userId);
  header("location: ../downloadpage.php");
  die;
}
else if (!isset($_COOKIE['remember-me']) && isset($_SESSION['user_id']))
{
  header("location: ../downloadpage.php");
  die;
}
else if (isset($_COOKIE['remember-me']) && isset($_SESSION['user_id']))
{
  header("location: ../downloadpage.php");
  die;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  // $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $passwordconf = $_POST["passwordconf"];
  $ccname = $_POST['ccname'];
  $ccnumber = $_POST['ccnumber'];
  $ccmonth = $_POST['ccmonth'];
  $ccyear = $_POST['ccyear'];
  $cvv = $_POST['cvv'];
  $controller = new UserController();
  $orderController = new OrderController;
  if (strlen($ccnumber) == 16) //CCNO is valid
  {
    $result = $controller->create($email, $password);
    if ($result >= 0)
    {

      $userData = $controller->show($email, $password, false);
      $_SESSION['user_id'] = $userData->id;
      $order = $orderController->create($_SESSION["user_id"], $product_id);
      header("Location:../downloadpage.php?product_id=$product_id");
      die;
    }
    else
    {
      $error = $result;
    }
  }
}

$title = "Payment";
$active = "payment";
const BASE_PATH = "/php-project/App/View";
define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
include "../includes/head.html";
include "../includes/header.html";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

</head>

<body>

  <div class="container mt-5 p-5 bg-light border-2 shadow border">
    <div class="row">
      <div class="col-8 mx-auto">

        <h2 class="d-flex justify-content-center pt-2 pb-2 row col-6 mx-auto mb-5 shadow border border-2 border-primary">
          Place an order
        </h2>
        <!--  ======== FORM START ==== FORM START ==== FORM START ==== FORM START ================================ -->
        <?php if (!empty($error))
        { ?>
          <div class="d-flex justify-content-center">
            <div class="alert alert-danger alert-dismissible fade show d-inline-block font-weight-bold" role="alert"><i class="fa fa-exclamation-circle ms-1"></i>
              <?= $error ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
        <?php } ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="border border-1 border-secondary p-3 pb-3 pt-3 mb-2">
            <div class="mb-3">
              <h4>Account credentials:</h4>
            </div>
            <!-- <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name">
              <div id="nameHelp" class="form-text"></div>
            </div> -->
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
              <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
              <div id="passhelp" class="form-text">Password should be at least 8 characters in length and
                it
                must include the following.
              </div>

            </div>

            <div class="mb-3">
              <label for="passwordconf" class="form-label">Confirm Password</label>
              <input type="password" class="form-control" id="passwordconf" name="passwordconf">
            </div>


            <!-- <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div> -->
          </div>
          <div class="border border-1 border-secondary p-3 pb-3 pt-3">
            <div class="mb-3">
              <h4>Card details:</h4>
            </div>

            <div class="row">

              <div class="row mb-2">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="ccname">Cardholder Name</label>
                    <input class="form-control" name="ccname" id="ccname" type="text" placeholder="Enter the cardholder name">
                  </div>
                </div>
              </div>

              <div class="row mb-2">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="ccnumber">Credit Card Number</label>
                    <div class="input-group">
                      <input class="form-control" type="text" placeholder="0000 0000 0000 0000" id="ccnumber" name="ccnumber">
                      <!-- <div class="input-group-append">
                          <span class="input-group-text">
                              <i class="mdi mdi-credit-card"></i>
                          </span>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="form-group col-sm-4">
                  <label for="ccmonth">Month</label>
                  <select class="form-control" id="ccmonth" name="ccmonth">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                    <option>11</option>
                    <option>12</option>
                  </select>
                </div>

                <div class="form-group col-sm-4">
                  <label for="ccyear">Year</label>
                  <select class="form-control" id="ccyear" name="ccyear">
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                    <option>2026</option>
                    <option>2027</option>
                    <option>2028</option>
                    <option>2029</option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="cvv">CVV/CVC</label>
                    <input class="form-control" id="cvv" type="text" placeholder="123" name="cvv">
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="btn-group mt-3">
            <button type="submit" class="btn btn-primary  me-3 border-1 border-dark" name="submit" value="submit" id="submit">Place Order
            </button>
            <button class="btn btn-light  border-1 border-dark"> Reset Fields</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</body>
<script src="../assets/js/bootstrap.bundle.min.js"></script>

</html>

<?php include "../includes/footer.html";

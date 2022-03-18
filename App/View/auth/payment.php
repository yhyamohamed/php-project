<?php

//open session ands loading the composer
session_start();
require_once("../../../vendor/autoload.php");

use App\Controllers\OrderController;
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
  Helper::redirect("../download.php");
  die();
}
else if (!isset($_COOKIE['remember-me']) && isset($_SESSION['user_id']))
{
  Helper::redirect("../download.php");
  die();
}
else if (isset($_COOKIE['remember-me']) && isset($_SESSION['user_id']))
{
  Helper::redirect("../download.php");
  die();
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
  $errors = [];
  foreach ($_POST as $key => $value)
  {
    if (empty($value))
    {
      $errors[] = "Empty $key";
    }
  }
  if (empty($errors))
  {
    if (strlen($ccnumber) == 16 && is_numeric($ccnumber) && intval($ccnumber) > 0)
    {
    }
    else
      $errors[] = "CC Number should consist of exactly 16 positive numbers!";

    if ($password === $passwordconf)
    {
    }
    else

      $errors[] = "The 2 passwords don't match";

    if (preg_match('/[^A-Za-z0-9]+/', $password) || strlen($password) >= 8)
    {
    }
    else
      $errors[] = "Password should have a mix of alphanumeric characters with at least 1 higher case character!";

    $result = $controller->create($email, $password);
    if ($result < 0)
    {
      $errors[] = "Problem with registration. Try again";
    }
  }
  if (empty($errors))
  {
    if ($result >= 0)
    {
      $userData = $controller->show($email, $password, false);
      if ($userData === false)
      {
        $errors[] = "Problem with the Email address. It may be already used";
      }
      else
      {
        $_SESSION['user_id'] = $userData->id;
        $order = $orderController->create($_SESSION["user_id"], $product_id);
        header("Location:../download.php?product_id=$product_id");
        die;
      }
    }
  }
}

$title = "Payment";
$active = "payment";
include "../includes/head.html";
include "../includes/header.html";
?>

<div class="container mt-5 p-5 border border-3 bg-light border-dark rounded-3 shadow-lg">
  <div class="row">
    <div class="col-8 mx-auto">

      <h2 class="border-bottom d-inline-block border-4 border-dark mb-5 display-5">
        Place an order
      </h2>
      <!--  ======== FORM START ==== FORM START ==== FORM START ==== FORM START ================================ -->
      <?php if (!empty($errors))
      {
        foreach ($errors as $error)
        { ?>
          <div class="d-flex justify-content-center">
            <div class="alert alert-danger alert-dismissible fade show d-inline-block font-weight-bold" role="alert">
              <i class="fa fa-exclamation-circle ms-1"></i>
              <?= $error ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
      <?php }
      } ?>
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="border border-2 rounded mb-5 p-4">
          <div class="mb-3">
            <h4>Account credentials:</h4>
          </div>
          <div class="mb-3 form-floating">
            <input placeholder="example@domain.com" required type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            <label for="email" class="form-label">Email address</label>
            <div id="emailHelp" class="small">We'll never share your email with anyone else.</div>
            <i class="fa fa-envelope-o position-absolute"></i>
          </div>
          <div class="mb-3 form-floating">
            <input placeholder="***" required type="password" class="form-control" id="password" name="password">
            <label for="password" class="form-label">Password</label>
            <div id="passhelp" class="small">Password should be at least 8 characters in length and
              it
              must include the following.
            </div>
            <i class="fa fa-lock position-absolute"></i>
          </div>
          <div class="mb-3 form-floating">
            <input placeholder="***" required type="password" class="form-control" id="passwordconf" name="passwordconf">
            <label for="passwordconf" class="form-label">Confirm Password</label>
            <i class="fa fa-lock position-absolute"></i>
          </div>


          <!-- <div class="mb-3 form-check">
            <input required type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div> -->
        </div>
        <div class="border border-2 rounded mb-5 p-4">
          <div class="mb-3">
            <h4>Card details:</h4>
          </div>

          <div class="row">

            <div class="row mb-2">
              <div class="col-sm-12">
                <div class=" form-floating">
                  <input required class="form-control" name="ccname" id="ccname" type="text" placeholder="Enter the cardholder name">
                  <label for="ccname">Cardholder Name</label>
                  <i class="fa fa-id-card-o position-absolute"></i>
                </div>
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-sm-12">
                <div class=" form-floating">
                  <input required class="form-control" type="text" placeholder="0000 0000 0000 0000" id="ccnumber" name="ccnumber">
                  <label for="ccnumber">Credit Card Number</label>
                  <i class="fa fa-credit-card position-absolute"></i>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-sm-4">
                <label for="ccmonth">Month</label>
                <select class="form-select text-white-50 bg-dark" id="ccmonth" name="ccmonth">
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
                <select class="form-select text-white-50 bg-dark" id="ccyear" name="ccyear">
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
                <div class=" form-floating">
                  <input required class="form-control" id="cvv" type="text" placeholder="123" name="cvv">
                  <label for="cvv">CVV/CVC</label>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="btn-group d-flex justify-content-center mt-3">
          <button class="btn btn-light flex-grow-0  border-1 border-dark"> Reset Fields</button>
          <button type="submit" class="btn btn-primary flex-grow-0  ms-3 border-1 border-dark" name="submit" value="submit" id="submit">Place Order
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
<?php include "../includes/footer.html";

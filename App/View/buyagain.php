<?php

//open session and loading the composer

//open session and loading the composer
session_start();
require_once("../../vendor/autoload.php");

use App\Controllers\OrderController;
use App\Controllers\UserController;
use App\Controllers\TokenController;
use App\Utilities\Helper;
//will be used fore redirection

$token = new TokenController();
$user = new UserController();
$orderController = new OrderController;
$product_id = 1;
//check for remember me
if (!isset($_SESSION['user_id']))
{
  Helper::redirect("auth/payment.php");
  die;
}
if (isset($_SESSION['user_id']))
{
  $download_count = $orderController->getDownloadCount($_SESSION["user_id"]) ?? 1;
  if ($download_count < 7)
  {
    Helper::redirect("auth/payment.php");
    die;
  }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $ccname = $_POST['ccname'];
  $ccnumber = $_POST['ccnumber'];
  $ccmonth = $_POST['ccmonth'];
  $ccyear = $_POST['ccyear'];
  $cvv = $_POST['cvv'];
  $errors = [];
  foreach ($_POST as $key => $value)
  {
    if (empty($value))
    {
      $errors[] = "Empty $key";
    }
  }

  if (strlen($ccnumber) == 16 && is_numeric($ccnumber) && intval($ccnumber) > 0) //CCNO is valid
  {
    $currentOrder = $orderController->showDetails($_SESSION["user_id"]);
    // print_r($currentOrder);
    // die();
    $currentOrder->download_count = 0;
    $order = $orderController->update($_SESSION["user_id"], (array)$currentOrder);

    // $order = $orderController->create($_SESSION["user_id"], $product_id);
    Helper::redirect("download.php?product_id=$product_id");
    die();
  }
  else
  {
    $errors[] = 'Invalid Credit Card';
  }
  if (empty($errors))
  {
  }
  else
  {
  }
}

$title = "Payment";
$active = "payment";
include "includes/head.html";
include "includes/header.html";
?>

<div class="container mt-5 p-5 border border-3 bg-light border-dark rounded-3 shadow-lg">
  <div class="row">
    <div class="col-8 mx-auto">

      <h2 class="border-bottom d-inline-block border-4 border-dark mb-5 display-5">
        Place an order
      </h2>
      <!--  ======== FORM START ==== FORM START ==== FORM START ==== FORM START ================================ -->
      <?php
      if (!empty($errors))
      {
        foreach ($errors as $error)
        {
      ?>
          <div class="d-flex justify-content-center">
            <div class="alert alert-danger alert-dismissible fade show d-inline-block font-weight-bold" role="alert"><i class="fa fa-exclamation-circle ms-1"></i>
              <?= $error ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          </div>
      <?php }
      } ?>
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

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
<?php include "includes/footer.html";

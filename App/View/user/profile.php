<?php

session_start();
require_once("../../../vendor/autoload.php");

use App\Controllers\OrderController;
use App\Controllers\TokenController;
use App\Controllers\UserController;
use App\Utilities\Helper;

$controller = new UserController();
$orderController = new OrderController();
$tokenController = new TokenController();
$userController = new UserController();

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

if (!isset($_SESSION['user_id']))
{
  Helper::redirect(BASE_PATH . "/auth/payment.php");
}
$id = $_SESSION['user_id'];

$userData = $controller->getDataByID($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  // $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $passwordconf = $_POST["passwordconf"];


  $result = $controller->edit($id, $email, $password);
  if ($result >= 0)
  {

    $userData = $controller->getDataByID($id);
  }
  else
  {
    $error = $result;
  }
}


// 1- render user orders in a table (Tab_1)
// 2- render a form filled with user credentials (Tab_2)
//      - email, password, confirm password
//      - submit button to update data
$title = 'Profile';
$active = 'profile';
include "../includes/head.html";
include "../includes/header.html";

$orders = $orderController->getUserOrders($id);

//
//var_dump($orders);
//die;
?>

<div class="container py-5">
  <nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <button class="nav-link active" id="nav-orders-tab" data-bs-toggle="tab" data-bs-target="#nav-orders" type="button" role="tab" aria-controls="nav-orders" aria-selected="true">Orders
      </button>
      <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile
      </button>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-orders" role="tabpanel" aria-labelledby="nav-orders-tab">
      <table class="table text-white-50 bg-light table-bordered">
        <thead>
          <tr>
            <th class="p-3" scope="col">Product Name</th>
            <th class="p-3" scope="col">Download Count</th>
            <th class="p-3" scope="col">Order Date</th>
          </tr>
        </thead>

        <tbody>
          <?php
          foreach ($orders as $order)
          {
          ?>
            <tr class="text-white">
              <td class="p-3"><?= $order->product_name ?></td>
              <td class="p-3"><?= $order->download_count ?></td>
              <td class="p-3"><?= $order->order_date ?></td>
            </tr>
          <?php }
          ?>
        </tbody>
      </table>
    </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
      <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="border border-1 border-secondary p-3 pb-3 pt-3 mb-2">
          <div class="mb-3">
            <h4>Account credentials:</h4>
          </div>
          <div class="mb-3 form-floating">
            <input placeholder="example@domain.com" type="email" class="form-control" id="email" value="<?= $userData->Email ?>" aria-describedby="emailHelp" name="email">
            <label for="email" class="form-label">Email address</label>
            <div id="emailHelp" class="small">We'll never share your email with anyone else.</div>
            <i class="fa fa-envelope-o position-absolute"></i>
          </div>
          <div class="mb-3 form-floating">
            <input placeholder="***" type="password" class="form-control" id="password" name="password">
            <label for="password" class="form-label">Password</label>
            <!--              <div id="passhelp" class="small">Password should be at least 8 characters in length and-->
            <!--                it-->
            <!--                must include the following.-->
            <!--              </div>-->
            <i class="fa fa-lock position-absolute"></i>
          </div>
          <div class="mb-3 form-floating">
            <input placeholder="***" type="password" class="form-control" id="passwordconf" name="passwordconf">
            <label for="passwordconf" class="form-label">Confirm Password</label>
            <i class="fa fa-lock position-absolute"></i>
          </div>
        </div>
        <div class="btn-group d-flex align-items-center justify-content-center mt-3">
          <button type="submit" class="btn btn-primary flex-grow-0 me-3 border-1 border-dark" name="submit" value="submit" id="submit">Update
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
include "../includes/footer.html";

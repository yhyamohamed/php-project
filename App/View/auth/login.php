<?php
session_start();
require_once("../../../vendor/autoload.php");

use App\Controllers\TokenController;
use App\Controllers\UserController;
use App\Utilities\Helper;


$error = '';
$tokenController = new TokenController();
$userController = new UserController();
$product_id = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  $remember_me = isset($_POST['remember_me']) ? 'on' : false;
  $controller = new UserController();
  if ($userData = $controller->show($email, $password, $remember_me))
  {
    $_SESSION['user_id'] = $userData->id;
    header('Location:../index.php');
    var_dump($_SESSION['user_id']);
    die();
  }
  else
  {
    $error = "Invalid Credentials";
  }
}

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

$title = "Login";
$active = "login";
include "../includes/head.html";
include "../includes/header.html";
?>
<div class="container">
  <div class="row">
    <div class="col-8 col-lg-6 m-auto mt-4">
      <?php if (!empty($error))
      { ?>
        <div class="d-flex justify-content-center">
          <div class="alert alert-danger alert-dismissible fade show d-inline-block font-weight-bold" role="alert"><i class="fas fa-exclamation-circle ms-1"></i>
            <?= $error ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        </div>
      <?php } ?>
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="d-flex justify-content-center mb-3">
          <p class="fs-1">Login</p>
        </div>
        <div class="mb-3 form-floating">
          <input placeholder="example@domain.com" type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
          <label for="email">Email address</label>
          <i class="fa fa-envelope-o position-absolute"></i>
        </div>
        <div class="mb-3 form-floating">
          <input placeholder="***" type="password" name="password" class="form-control" id="password">
          <label for="password">Password</label>
          <i class="fa fa-lock position-absolute"></i>
        </div>
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" name="remember_me" type="checkbox" id="flexSwitchCheckDefault">
          <label class="form-check-label" for="flexSwitchCheckDefault">Remember Me!</label>
        </div>
        <div class="d-flex justify-content-center mb-3">
          <button type="submit" class="btn btn-primary m-auto">Login</button>
        </div>
        <div class="d-flex justify-content-center mb-3">
          <p>Don't have an account yet? &nbsp;
            <a href="payment.php"> Click here to sign-up!</a>
          </p>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
include "../includes/footer.html";

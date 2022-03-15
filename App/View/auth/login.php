<?php
  session_start();
  require_once("../../../vendor/autoload.php");
  use App\Controllers\UserController;
  $error = '';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $remember_me = isset($_POST['remember_me'])? 'on':false;
    $controller = new UserController();
    if ($userData = $controller->show($email, $password, $remember_me)) {
      $_SESSION['user_id'] = $userData->id;
      header('Location:../index.php');
      var_dump($_SESSION['user_id']);
      die;
    } else {
      $error = "Invalid Credentials";
    }
  }
  $title = "Login";
  $active = "login";
  const BASE_PATH = "/PhpProject/php-project/App/View";
  define("BASE_URL", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . BASE_PATH);
  include "../includes/head.html";
  include "../includes/header.html";
?>
<div class="container">
  <div class="row">
    <div class="col-8 m-auto mt-4">
      <?php if (!empty($error)) { ?>
      <div class="d-flex justify-content-center">
        <div class="alert alert-danger alert-dismissible fade show d-inline-block font-weight-bold" role="alert"><i
              class="fas fa-exclamation-circle ms-1"></i>
          <?= $error ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
     <?php } ?>
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <div class="d-flex justify-content-center mb-3">
          <p class="fs-1">Login</p>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="fs-4 form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="fs-4 form-label">Password</label>
          <input type="password" name="password" class="form-control" id="inputPassword">
        </div>
        <div class="form-check form-switch mb-3">
          <input class="form-check-input" name="remember_me" type="checkbox" id="flexSwitchCheckDefault">
          <label class="form-check-label" for="flexSwitchCheckDefault">Remember Me!</label>
        </div>
        <div class="d-flex justify-content-center mb-3">
          <button type="submit" class="btn btn-dark fs-4 m-auto">Login</button>
        </div>
        <div class="d-flex justify-content-center mb-3">
          <p>Don't have an account yet? </p>
          <a href="#" class="link-primary"> Click here to sign-up!</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
  include "../includes/footer.html";
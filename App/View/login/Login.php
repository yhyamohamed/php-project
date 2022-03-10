<?php
require_once("../../../vendor/autoload.php");
use App\Controllers\UserController;
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $controller = new UserController();
  $userData = $controller->show($email, $password, false);
  var_dump($userData);
//  if ($_POST['email'] == $username && $_POST['password'] == $password) {
//      $_SESSION['Session_ID'] = 5;
//      $_SESSION['username'] = md5($_POST['email']);
//      $_SESSION['password'] = sha1($_POST['password']);
//      header('Location:index.php');
//  }
//  else {
//      header('Location:viewtest.php');
//  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Login.css">
    <script src="https://kit.fontawesome.com/4d3d726ccd.js" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <nav class="navbar p-3 mb- navbar-dark bg-dark navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand fw-light" href="#">Themify!</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-th-list me-1"></i>Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-pound-sign me-1"></i>Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-users me-1"></i>Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-download me-1"></i>Downloads</a>
                    </li>
                    <li class="nav-item ms-auto">
                        <a class="nav-link active" aria-current="page" href="/Trials/Php_project/php-project/App/View/Login.php"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-user-plus me-1"></i>Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-sign-out-alt me-1"></i>Logout</a>
                    </li>
                </ul>
            </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-8 m-auto mt-4">
                <div class="d-flex justify-content-center">
                    <div class="alert alert-danger alert-dismissible fade show d-inline-block" role="alert"><i class="fas fa-exclamation-circle ms-1"></i>
                        <strong>Either Username or Password Wrong!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
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
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
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
</body>

</html>
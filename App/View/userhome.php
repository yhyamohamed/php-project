<?php
session_start();
require_once("C:xampp/htdocs/php-project/vendor/autoload.php");
// $user_obj = new User();
$User_cont = new UserController();
if (isset($_SESSION['user_id'])) {
    // $id = $_SESSION['user_id'];
    $user = $User_cont->show($_SESSION['user_id']);
}

// var_dump($_SESSION['user_id']);

// require_once("p2.php");

var_dump($user);
?>
<h1>profile page</h1>
<a href="http://localhost:8080/php-project/App/View/profile_edit.php">edit_profile</a>
<a href="http://localhost:8080/php-project/App/View/logout.php">logout</a>
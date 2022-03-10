<?php
session_start();
require_once("C:xampp/htdocs/php-project/vendor/autoload.php");
$User_cont = new UserController();
$User_cont->destroy($_SESSION['user_id']);
header("Location:login.php");

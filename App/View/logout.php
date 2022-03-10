<?php
session_start();
require_once("C:xampp/htdocs/php tasks/phpfinal/php-project/vendor/autoload.php");
$user_cont = new UserController();
$user_cont->logout();

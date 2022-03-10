<?php
session_start();
require_once("C:/xampp/htdocs/php-project/vendor/autoload.php");
$user_obj = new User();
$User_cont = new UserController();
echo $_SERVER['REQUEST_METHOD'];
if (isset($_POST['email']) && isset($_POST['password'])) {
    $user_obj->set_email($_POST['email']);
    $user_obj->set_password($_POST['password']);
    $id = $user_obj->login();
    if (is_numeric($id) && $id >= 0) {
        $_SESSION['user_id'] = $id;
        header("Location:userhome.php");
    } else {
        $error = "wrong user name or password";
        echo "$error";
    }
}
?>
<html>
<body>
    <a href="http://localhost:8080/php-project/App/View/register.php">register</a>
    <form action="#" method="POST">
        <input type="text" name="email" />
        <input type="text" name="password" />
        <button type="submit">submit</button>
    </form>
</body>
</html>
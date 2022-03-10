<?php
session_start();
require_once("C:xampp/htdocs/php tasks/phpfinal/php-project/vendor/autoload.php");
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


    // redirect to profile page
    // 
    //     $user = $User_cont->show($id);
    //     $GLOBALS['user'] = $user;
    //     var_dump($GLOBALS['user']);
    // }
}
// var_dump($_SESSION['user_id']);

// require_once("p2.php");

?>

<html>

<body>

    <a href="http://localhost/php%20tasks/phpfinal/php-project/App/View/register.php">register</a>
    <form action="#" method="POST">
        <input type="text" name="email">
        <input type="text" name="password">
        <button type="submit">submit</button>


    </form>

    }


</body>



</html>
<?php
session_start();
require_once("C:xampp/htdocs/php tasks/phpfinal/php-project/vendor/autoload.php");
$user_cont = new UserController();
if (isset($_POST['email'])) {
    $user_cont->store();
}


?>

<html>

<body>


    <form action="#" method="POST">
        <table>
        <tr>
                <td>
                    <p>enter your email</p>
                </td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>
                    <p>enter your password</p>
                </td>
                <td><input type="text" name="password"></td>
            </tr>
            
        </table>
        <button type="submit">submit</button>


    </form>




</body>



</html>
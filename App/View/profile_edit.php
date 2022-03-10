<?php
session_start();
require_once("C:xampp/htdocs/php tasks/phpfinal/php-project/vendor/autoload.php");
// $user_obj = new User();
$User_cont = new UserController();
if (isset($_SESSION['user_id'])) {
    // $id = $_SESSION['user_id'];
    $user = $User_cont->show($_SESSION['user_id']);
}
if (isset($_POST['submit_edit'])) {
    $User_cont->update($_SESSION['user_id']);
}

?>


<html>

<body>
    <form action="#" method="POST">
        <table>
            <tr>
                <td>
                    <p> email</p>
                </td>
                <td><input type="text" name="email" value="<?php echo $user->Email;   ?>"></td>
            </tr>
            <tr>
                <td>
                    <p> password</p>
                </td>
                <td><input type="text" name="password" value="<?php echo $user->password;   ?>"></td>
            </tr>

        </table>
        <button type="submit" name="submit_edit">submit</button>



    </form>
    <a href="http://localhost/php%20tasks/phpfinal/php-project/App/View/delete.php">delete_my_account</a>



    </form>
</body>


</html>
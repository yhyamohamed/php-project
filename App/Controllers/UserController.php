<?php


// use Illuminate\Database\capsule\Manager as Capsule;

class UserController implements Controller
{
    // public function connect()
    // {
    //     $this->capsule = new Capsule();
    //     $this->capsule->addConnection([
    //         "driver" => _driver_,
    //         "host" => _host_,
    //         "database" => _database_,
    //         "username" => _username_,
    //         "password" => _password_
    //     ]);
    //     $this->capsule->setAsGlobal();
    //     $this->capsule->bootEloquent();
    // }
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function show($id)
    {
        // //to get record entered from database
        // $user =   Capsule::table('users')->where('Email', $email)->first();
        // //check if entered data is correct
        // if ($user->Email === $email && $user->password === $password) {
        //     return true;
        //     //should redirect the user to his home page
        // } else return false;
        // return Capsule::table('users');


        if (is_numeric($id)) {
            if (isset($_SESSION['user_id'])) {
                $user_obj = new User();
                $data = $user_obj->getdata($id);
                // put data in session  
                return $user_obj->getdata($id);
            }
        }
    }
    public function store()
    {
        $user = new User();
        $user->set_email($_POST['email']);
        $user->set_password($_POST['password']);
        $user->set_token($this->generateRandomString(6));
        $user->register();
        $_SESSION['user_id'] = $user->login();

        header("Location:userhome.php");
    }

    public function update($id)
    {
        $user = new User();
        $user->set_email($_POST['email']);
        $user->set_password($_POST['password']);
        $user->update($id);
    }
    public function destroy($id)
    {
        $user = new User();
        $user->delete($id);
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location:login.php");
    }
}

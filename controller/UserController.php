<?php
session_start();
require_once("vendor/autoload.php");

use Illuminate\Database\capsule\Manager as Capsule;

class UserController
{
    public function connect()
    {
        $this->capsule = new Capsule();
        $this->capsule->addConnection([
            "driver" => _driver_,
            "host" => _host_,
            "database" => _database_,
            "username" => _username_,
            "password" => _password_
        ]);
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    public function login($email, $password)
    {
        //to get record entered from database
        $user =   Capsule::table('users')->where('Email', $email)->first();
        //check if entered data is correct
        if ($user->Email === $email && $user->password === $password) {
            return true;
            //should redirect the user to his home page
        } else return false;
    }
}
// $users = Capsule::table('users')->get();
// require_once("p.php");

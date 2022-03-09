<?php

namespace App\Model;


use Illuminate\Database\Capsule\Manager as Capsule;

class User implements UserTest
{
    public dbConnection $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new dbConnection;
    }
    public function login($email,$hashedPass)
    {
        $users = Capsule::table('Users')
        ->where('Email', $email)
        ->where('password', $hashedPass)
        ->get();
        return $users;
    }
    public function logout()
    {
    }
    public function register()
    {
    }
    public function update($id)
    {
    }
    public function delete($id)
    {
    }
    public function getdata($id)
    {
    }
}

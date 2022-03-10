<?php

use Illuminate\Database\capsule\Manager as Capsule;

class User implements UserTest
{
    private $id;
    private $email;
    private $password;
    private $token;


    public function set_id($user_id)
    {
        $this->id = $user_id;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function set_email($user_email)
    {
        $this->email = $user_email;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function set_password($user_password)
    {
        $this->password = $user_password;
    }
    public function get_password()
    {
        return $this->password;
    }
    public function set_token($user_token)
    {
        $this->token = $user_token;
    }
    public function get_token()
    {
        return $this->token;
    }

    function __construct()
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
    public function login()
    {
        $email = $this->get_email();
        $password = $this->get_password();
        $user =   Capsule::table('users')->where('Email', $email)->first();
        if ($user->Email === $email && $user->password === $password) {

            return $user->id;
        } else return -1;
    }
    public function getdata($id)
    {
        $user = Capsule::table('users')->find($id);
        return $user;
    }
    public function register()
    {
        Capsule::table('users')->insert([
            'Email' => $this->get_email(),
            'password' => $this->get_password(),
            'remeber_me_token' => $this->get_token()
        ]);
    }
    public function update($id)
    {
        Capsule::table('users')->where('id', $id)->update(['Email' => $this->get_email(), 'password' => $this->get_password()]);
    }
    public function delete($id){

        Capsule::table('users')->where('id', $id)->delete();
    }
   
}

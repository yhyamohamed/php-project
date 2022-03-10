<?php

namespace App\Controllers;

use App\Model\User;


class UserController implements Controller
{
    public User $user;

    public function __construct()
    {
        $this->user = new User;
    }

    public function index()
    {
        return $this->user->getAllUsers();
    }

    public function create($email, $pass)
    {
        $useremail = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        $pass = htmlspecialchars(trim($pass));
        $user = ([
            'email' =>  $useremail,
            'password' =>  sha1($pass)

        ]);
        $this->store($user);
    }
    // return ok or Error 
    public function store($user)
    {
        return $this->user->register($user);
    }

    // return: 
    // array of 1 object
    //[id] => 
    //[Email] => 
    //[password] => 
    //[remeber_me_token] => 
    // or empty array 
    public function show($useremail, $pass, $rememberMeFlag)
    {
        //validate
        $useremail = filter_var(trim($useremail), FILTER_SANITIZE_EMAIL);
        $pass = htmlspecialchars(trim($pass));
        // send to model
        //to do generate remember me token
        return $this->user->login($useremail, sha1($pass));
    }
    public function search($useremail)
    {
        $useremail = filter_var(trim($useremail), FILTER_SANITIZE_EMAIL);
        return $this->user->findByEmail($useremail);
    }
    // to pass only password edit(7,pass:1234567);
    public function edit($id, $email = null, $pass = null)
    {
        //get user data
        $userToEdit = $this->user->getData($id);
        if ($userToEdit) {
            $emailToedit = $email ?? $userToEdit->Email;
            $passToedit = sha1($pass) ?? $userToEdit->password;
            $userData = ([
                'email' =>  $emailToedit,
                'password' => $passToedit

            ]);
            $this->update($id, $userData);
        }else{
            return 'Error invalid id';
        }
    }
    public function update($id, $user)
    {
        return $this->user->update($id, $user);
    }
    public function destroy($id)
    {
        echo $this->user->delete($id);
    }
}

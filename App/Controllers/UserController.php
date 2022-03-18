<?php

namespace App\Controllers;

use App\Model\User;
use App\Controllers\TokenController;
use App\Controllers\OrderController;
use Exception;


class UserController implements Controller
{
    public User $user;


    public function __construct()
    {
        $this->user = new User;
        $this->tokenController = new TokenController;
        $this->ordersController = new OrderController;
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
        return $this->store($user);
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
        $user = $this->user->login($useremail, sha1($pass));
        if (isset($user)) {
          // generate remember me token
          if ($user && $rememberMeFlag === 'on' && !isset($_COOKIE['remember-me'])) {
            $this->tokenController->create($user->id);
          } else {
            //find tokens
            $tokens = $this->tokenController->searchallUserTokens($user->id);
            //will return index of first matched token or null
            $foundIndex = array_search($_COOKIE['remember-me'], array_column(json_decode($tokens), 'remeber_me_token'));

            if ($foundIndex >= 0) {
              $token_id = $tokens[$foundIndex]->id;
              $this->tokenController->editOrRenwToken($token_id, true);
            }
          }
          //attatch orders & tokens with user obj
          $user->{'tokens'} = $this->tokenController->searchallUserTokens($user->id);
          $user->{'orders'} = $this->ordersController->getDownloadCount($user->id);
        return $user;
        }
        return false;
    }
    public function getDataByID($id){
        return $this->user->getData($id);
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
        } else {
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
    public function loginWithToken($userId)
    {
        $tokens = $this->tokenController->searchallUserTokens($userId);
        $foundIndex = array_search($_COOKIE['remember-me'], array_column(json_decode($tokens), 'remeber_me_token'));
        if ($foundIndex >= 0) {
            $token_id = $tokens[$foundIndex]->id;
            $this->tokenController->editOrRenwToken($token_id, true);
        }
    }
    public function logOut($token)
    {
       //to do 
            // unset session & destroy it 
       //delete token from cookie & database
      try {
        $this->tokenController->deleteByTokenName($token);
      } catch (Exception $exception) {

      }
    }
}

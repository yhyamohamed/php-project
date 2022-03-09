<?php

namespace App\Controllers;
use App\Model\User;


class USerController implements Controller
{
    public User $user;

    public function __construct()
    {
       $this->user= new User;
    }
    public function index(){
        
    }
    public function create(){
        
    }
     public function store($user){
         
     }
    public function show($useremail,$pass){
        //validate
       $useremail = filter_var(trim($useremail),FILTER_SANITIZE_EMAIL);
        $pass = htmlspecialchars(trim($pass));
        // send to model
        $user = $this->user->login($useremail,sha1($pass));
        // return response to view
        return $user;
    }
    public function edit($id){
        
    } 
    public function update($id){
        
    } 
    public function destroy($id){
        
    }
}

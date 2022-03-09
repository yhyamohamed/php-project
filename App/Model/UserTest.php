<?php

namespace App\Model;

interface UserTest
{
    // note: 1- implement setter for database fields

    // 2-functions 
    public function login($email, $hashedPass);
    public function logout();
    public function register($user);
    public function update($id,$data);
    public function delete($id);
    public function getData($id);
    public function getAllUsers();
    public function findByEmail($email);
}

<?php

namespace App\Model;


use Illuminate\Database\Capsule\Manager as Capsule;

class User implements UserTest
{
    public dbConnection $dbConnection;
    var $table;
    public function __construct()
    {
        $this->dbConnection = new dbConnection;
        $this->table =  Capsule::table('Users');
    }
    public function login($email, $hashedPass)
    {
        return $this->table
            ->where('Email', $email)
            ->where('password', $hashedPass)
            ->get();
    }
    public function logout()
    {
    }
    public function register($user)
    {
        try {
            $this->table->insert($user);
            return "ok";
        } catch (\PDOException $ex) {
            // return $ex->getMessage();
            return "Error ";
        }
    }
    public function update($id, $data)
    {
        try {
            $this->table->where('id', $id)
                ->update($data);
            return "ok";
        } catch (\PDOException $ex) {
            // return $ex->getMessage();
            return "Error ";
        }
    }
    public function delete($id)
    {

        try {
            $this->table->where('id', $id)
                ->delete();
            return "ok";
        } catch (\PDOException $ex) {
            return $ex->getMessage();
            // return "Error ";
        }
    }
    public function getData($id)
    {
        return $this->table
            ->find($id);
    }
    public function findByEmail($email)
    {
        return $this->table
            ->where('email', 'like', "%$email%")
            ->get();
    }
    public function getAllUsers()
    {
        $users = $this->table
            ->select('email')
            ->get();
        return $users;
    }
}

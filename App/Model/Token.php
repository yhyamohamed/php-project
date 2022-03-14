<?php

namespace App\Model;


use Illuminate\Database\Capsule\Manager as Capsule;

class Token
{
    public dbConnection $dbConnection;
    var $table;
    public function __construct()
    {
        $this->dbConnection = new dbConnection;
        $this->table =  Capsule::table('Tokens');
    }
    public function addToken($tokenData)
    {
        try {
            
            return $this->table->insertGetId($tokenData);
        } catch (\PDOException $ex) {
            // return $ex->getMessage();
            return "Error ";
        }
    }
    public function updateToken($tokenId,$tokenData)
    {
        try {
            $this->table->where('id', $tokenId)
                ->update($tokenData);
            return "token updated";
        } catch (\PDOException $ex) {
            // return $ex->getMessage();
            return "Error ";
        }
    }
    public function delete($tokenId)
    {

        try {
            $this->table->where('id', $tokenId)
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
    public function getAllUserTokens($user_id)
    {
        return $this->table
            ->where('user_id',  $user_id)
            ->get();
    }
    public function findUnusedTokens($user_id)
    {
        return $this->table
            ->where('user_id',  $user_id)
            ->where('isused',  'false')
            ->get();
    }
    public function findToken($token)
    {
        return $this->table
            ->where('remeber_me_token',  $token)
            ->get()->first();
    }
    
}

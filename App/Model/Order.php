<?php

namespace App\Model;


use Illuminate\Database\Capsule\Manager as Capsule;

class Order
{
    public dbConnection $dbConnection;
    var $table;
    public function __construct()
    {
        $this->dbConnection = new dbConnection;
        $this->table =  Capsule::table('orders');
    }

    public function add($order)
    {
        try {
            return $this->table->insertGetId($order);;
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
            // return $ex->getMessage();
            return "Error ";
        }
    }
    public function getData($id)
    {
        return $this->table
            ->find($id);
    }
    public function findByName($product_name, $userId)
    {
        return $this->table
            ->where('product_name', 'like', "%$product_name%")
            ->where('user_id',  $userId)
            ->get();
    }
    public function findUserOrders( $userId)
    {
        return $this->table
            ->where('user_id',  $userId)
            ->get();
    }
    public function getAllOrders()
    {
       return $this->table
            ->select('*')
            ->get();
       
    }
}

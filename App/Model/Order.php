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
        try
        {
            return $this->table->insertGetId($order);
        }
        catch (\PDOException $ex)
        {
            // return $ex->getMessage();
            return "Error ";
        }
    }
    public function update($id, $data)
    {
        // echo "<br> ===== id: $id - data: $data ";
        // print_r($data);
        // die();
        try
        {
            $this->table
                ->where('id', $id)
                ->update($data);
            return "ok";
        }
        catch (\PDOException $ex)
        {
            return $ex->getMessage();

            // return "Error ";
        }
    }
    public function delete($id)
    {

        try
        {
            $this->table->where('id', $id)
                ->delete();
            return "ok";
        }
        catch (\PDOException $ex)
        {
            // return $ex->getMessage();
            return "Error ";
        }
    }
    public function getData($id)
    {
        return $this->table
            ->find($id);
    }

    public function findByIds($userId, $product_id)
    {

        return $this->table
            ->where('user_id',  $userId)
            ->where('product_id', $product_id)
            ->get()->first();
    }
    public function findUserOrders($userId)
    {
        return $this->table
            ->where('user_id',  $userId)
            ->get()->toArray();
    }
    public function getAllOrders()
    {
        return $this->table
            ->select('*')
            ->get();
    }
}

<?php

namespace App\Model;


use Illuminate\Database\Capsule\Manager as Capsule;

class Product
{
    public dbConnection $dbConnection;
    var $table;
    public function __construct()
    {
        $this->dbConnection = new dbConnection;
        $this->table =  Capsule::table('products');
    }

    public function add($product)
    {
        try
        {
            return $this->table->insertGetId($product);;
        }
        catch (\PDOException $ex)
        {
            // return $ex->getMessage();
            return "Error ";
        }
    }
    public function update($id, $data)
    {
        try
        {
            $this->table->where('id', $id)
                ->update($data);
            return "ok";
        }
        catch (\PDOException $ex)
        {
            // return $ex->getMessage();
            return "Error ";
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
    public function findByName($pname)
    {
        return $this->table
            ->where('product_name', 'like', "%$pname%")
            ->get()->first();
    }
    public function getAllProducts()
    {
        $products = $this->table
            ->select('*')
            ->get()->first();;
        return $products;
    }
}

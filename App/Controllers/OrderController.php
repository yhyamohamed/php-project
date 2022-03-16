<?php

namespace App\Controllers;

use App\Model\Order;
use App\Model\Product;


class OrderController
{
    public Order $Order;

    public function __construct()
    {
        $this->Order = new Order;
        $this->Product = new Product;
    }

    public function index()
    {
        return $this->Order->getAllOrders();
    }

    public function create($user_id, $product_id)
    {
        $user_id = filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
        $product_id = filter_var($product_id, FILTER_SANITIZE_NUMBER_INT);

        $Order = ([
            'user_id' =>  $user_id,
            'product_id' =>  $product_id

        ]);
        // echo "Hiii 123 ";
        // print_r($Order);
        // die();
        return $this->store($Order);
    }

    public function store($Order)
    {
        // echo "hello 1 " . $this->Order->add($Order);
        return $this->Order->add($Order);
    }

    public function showDetails($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this->Order->getData($id);
    }
    public function search($product_name, $user_id)
    {

        $product_name = htmlspecialchars(trim($product_name));
        $Product = $this->Product->findByName($product_name);
        return $this->Order->findByIds($Product->id, $user_id);
    }

    public function edit($id, $pname = null, $link = null)
    {
        // //get Order data
        // $OrderToEdit = $this->Order->getData($id);
        // if ($OrderToEdit) {
        //     $pnameToedit = $pname ?? $OrderToEdit->Order_name;
        //     $linkToedit = $link  ?? $OrderToEdit->download_file_link;
        //     $OrderData = ([
        //         'Order_name' =>  $pnameToedit ,
        //         'download_file_link' => $linkToedit

        //     ]);
        //     $this->update($id, $OrderData);
        // } else {
        //     return 'Error invalid id';
        // }
    }
    public function update($id, $Order)
    {
        return $this->Order->update($id, $Order);
    }
    public function getUserOrders($user_id)
    {
        return $this->Order->findUserOrders($user_id);
    }
    public function incrementDownloadCount($user_id, $product_id = 1)
    {

        $order2 = $this->Order->findByIds($user_id, $product_id);
        $data = (['download_count' => ($order2->download_count + 1)]);
        // echo "Helloo<br>";
        // print_r($data);
        //ok or Error

        return $this->Order->update(
            $order2->id,
            $data
        );
    }
    public function getDownloadCount($user_id, $product_id = 1)
    {
        $order = $this->Order->findByIds($user_id, $product_id);


        return $order->download_count;
    }
    public function destroy($id)
    {
        return $this->Order->delete($id);
    }
}

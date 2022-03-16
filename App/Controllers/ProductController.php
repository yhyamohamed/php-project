<?php

namespace App\Controllers;

use App\Model\Product;


class ProductController
{
    public Product $Product;

    public function __construct()
    {
        $this->Product = new Product;
    }

    public function index()
    {
        return $this->Product->getAllProducts();
    }

    public function create($name, $link)
    {
        $Productname = htmlspecialchars(trim($name));
        $link = htmlspecialchars(trim($link));
        $Product = ([
            'product_name' =>  $Productname,
            'download_file_link' =>  $link

        ]);
        return $this->store($Product);
    }

    public function store($Product)
    {
        return $this->Product->add($Product);
    }

    public function showDetails($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this->Product->getData($id);
    }
    public function search($Product_name)
    {
        $Product_name = htmlspecialchars(trim($Product_name));
        return $this->Product->findByName($Product_name);
    }

    public function edit($id, $pname = null, $link = null)
    {
        //get Product data
        $ProductToEdit = $this->Product->getData($id);
        if ($ProductToEdit)
        {
            $pnameToedit = $pname ?? $ProductToEdit->product_name;
            $linkToedit = $link  ?? $ProductToEdit->download_file_link;
            $ProductData = ([
                'product_name' =>  $pnameToedit,
                'download_file_link' => $linkToedit

            ]);
            $this->update($id, $ProductData);
        }
        else
        {
            return 'Error invalid id';
        }
    }
    public function update($id, $Product)
    {
        return $this->Product->update($id, $Product);
    }
    public function destroy($id)
    {
        echo $this->Product->delete($id);
    }
}

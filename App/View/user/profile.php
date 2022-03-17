<?php

session_start();
require_once("../../../vendor/autoload.php");

use App\Controllers\OrderController;

// 1- render user orders in a table (Tab_1)
// 2- render a form filled with user credentials (Tab_2)
//      - email, password, confirm password
//      - submit button to update data
$title = 'Profile';
$active = 'profile';
include "../includes/head.html";
include "../includes/header.html";
$orderController = new OrderController();
$orders = $orderController->getUserOrders(2);

?>

<div class="container py-5">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-orders-tab" data-bs-toggle="tab" data-bs-target="#nav-orders" type="button" role="tab" aria-controls="nav-orders" aria-selected="true">Orders</button>
            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-orders" role="tabpanel" aria-labelledby="nav-orders-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Download Count</th>
                        <th scope="col">Order Date</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    foreach($orders as $order){
                    ?>
                    <tr>
                        <td><?= $order->product_name ?></td>
                        <td><?= $order->download_count ?></td>
                        <td><?= $order->order_date ?></td>
                    </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
    </div>
</div>

<?php
include "../includes/footer.html";

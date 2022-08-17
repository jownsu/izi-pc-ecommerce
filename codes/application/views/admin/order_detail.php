<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>(Order Detail Page)</title>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap-utilities.min.css" integrity="sha512-zaB1zReS2QONsLmpHDzDuNInQ7m4rswNiOXRWYkwxx3YDLz0AuryPJCbsWeoUM/7ZEOY0ZYXQdkei0Kac5gc1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    </head>
    <body>
        <div class="container-xl _container">
            <header class="d-flex align-items-center">
                <a href="<?= base_url('dashboard') ?>" class="me-3"><h2>Dashboard</h2></a>
                <a href="<?= base_url('dashboard/orders') ?>" class="me-3"><h3>Orders</h3></a>
                <a href="<?= base_url('dashboard/products') ?>" class="me-3"><h3>Products</h3></a>
                <a class="btn-warning p-2 ms-auto" href="<?= base_url('users/logout') ?>">Log off</a>
            </header>
            <main>
                <div class="row">
                    <div class="col col-md-3">
                        <div class="admin_order_info">
                            <p class="fs-4 fw-bold mb-3">Order ID: <?= $order['id'] ?></p>
                            <p class="fs-6 fw-bold mb-2">Customer shipping info:</p>
                            <div>
                                <span>Name: </span>
                                <p><?= $order['s_name'] ?></p>
                            </div>
                            <div>
                                <span>Address: </span>
                                <p><?= $order['s_address'] ?></p></div>
                            <div>
                                <span>City: </span>
                                <p><?= $order['s_city'] ?></p>
                            </div>
                            <div>
                                <span>State: </span>
                                <p><?= $order['s_state'] ?></p>
                            </div>
                            <div>
                                <span>Zip: </span>
                                <p><?= $order['s_zipcode'] ?></p>
                            </div>

                            <p class="fs-6 fw-bold mt-3">Customer billing info:</p>
                            <div>
                                <span>Name: </span>
                                <p><?= $order['b_name'] ?></p>
                            </div>
                            <div>
                                <span>Address: </span>
                                <p><?= $order['b_address'] ?></p>
                            </div>
                            <div>
                                <span>City: </span>
                                <p><?= $order['b_city'] ?></p>
                            </div>
                            <div>
                                <span>State: </span>
                                <p><?= $order['b_state'] ?></p>
                            </div>
                            <div>
                                <span>Zip: </span>
                                <p><?= $order['b_zipcode'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-9">
                        <table class="admin_order_info_table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
            if(!empty($order_products)){
                $sub_total = 0;
                foreach($order_products as $product){
                    $sub_total += $product['price'] * $product['quantity'];
?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td><?= $product['product_name'] ?></td>
                                    <td>&#8369;<?= $product['price'] ?></td>
                                    <td><?= $product['quantity'] ?></td>
                                    <td>&#8369;<?= $product['price'] * $product['quantity'] ?></td>
                                </tr>
<?php
                }
            }
?>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between align-items-center mt-4">
<?php
                    if($order['status'] == 1){
?>
                        <p class="in_process_color">Status: <span>In process</span></p>
<?php
                    }
                    else if ($order['status'] == 2){
?>
                        <p class="shipped_color">Status: <span>Shipped</span></p>

<?php
                    }
                    else if ($order['status'] == 3){
?>
                        <p class="cancelled_color">Status: <span>Cancelled</span></p>
<?php
                    }
?>
                    
                            <div class="order_info">
                                <div class="d-flex justify-content-between mb-1">
                                    <p>Sub Total: </p>
                                    <p>&#8369;<span><?= number_format((float)$sub_total, 2, '.', '') ?></span></p>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <p>Shipping: </p>
                                    <p>&#8369;<span>50.00</span></p>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <p>Total Price: </p>
                                    <p>&#8369;<span><?= number_format((float)$sub_total + 50, 2, '.', '') ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    
            </main>
        </div>

    </body>
</html>
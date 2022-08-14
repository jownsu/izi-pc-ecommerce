<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Dashboard Orders)</title>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <script src="<?= base_url('assets/js/admin/orders_dashboard.js') ?>"></script>
</head>
<body>
    <div class="container-xl _container">
        <header>
            <a href="admin_orders_dashboard_page.html"><h2>Dashboard</h2></a>
            <a href="admin_orders_dashboard_page.html"><h3>Orders</h3></a>
            <a href="admin_products_dashboard_page.html"><h3>Products</h3></a>
            <a class="nav_end" href="../login_register/login_page.html"><h3>Log off</h3></a>
        </header>
        <main>
            <p class="message_admin_orders"></p>
            <form class="form_admin_orders" action="" method="post">
                <input type="search" name="admin_orders_search" placeholder="&#x1F50D; search" />
                <select name="admin_orders_status">
                    <option value="0">Show All</option>
                    <option>Order in process</option>
                    <option>Shipped</option>
                    <option>Cancelled</option>
                </select>
            </form>
            <table class="admin_orders_table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Billing Address</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="admin_order_detail_page.html">100</a></td>
                        <td>Bob</td>
                        <td>9/6/2014</td>
                        <td>123 dojo way Bellevue WA 98005</td>
                        <td>$149.99</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="product_id" value="product_id"/>
                                <select name="admin_orders_update">
                                    <option>Order in process</option>
                                    <option selected>Shipped</option>
                                    <option>Cancelled</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    <tr class="color1">
                        <td><a href="admin_order_detail_page.html">99</a></td>
                        <td>Bob</td>
                        <td>9/6/2014</td>
                        <td>123 dojo way Bellevue WA 98005</td>
                        <td>$149.99</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="product_id" value="product_id"/>
                                <select name="admin_orders_update">
                                    <option>Order in process</option>
                                    <option selected>Shipped</option>
                                    <option>Cancelled</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="admin_order_detail_page.html">98</a></td>
                        <td>Bob</td>
                        <td>9/6/2014</td>
                        <td>123 dojo way Bellevue WA 98005</td>
                        <td>$149.99</td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="product_id" value="product_id"/>
                                <select name="admin_orders_update">
                                    <option value="1">Order in process</option>
                                    <option value="2" selected>Shipped</option>
                                    <option value="3">Cancelled</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <section class="pagination">
                <a href="">1</a><!--
             --><a href="">2</a><!--
             --><a href="">3</a><!--
             --><a href="">4</a><!--
             --><a href="">5</a><!--
             --><a href="">6</a><!--
             --><a href="">7</a><!--
             --><a href="">8</a><!--
             --><a href="">9</a><!--
             --><a href="">10</a><!--
             --><a class="next_page" href="">&rsaquo;</a>
            </section>
        </main>
    </div>

</body>
</html>
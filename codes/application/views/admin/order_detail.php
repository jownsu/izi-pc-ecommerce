<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Order Detail Page)</title>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>
    <div class="container-xl _container">
        <header class="header_admin">
            <a href="admin_orders_dashboard_page.html"><h2>Dashboard</h2></a>
            <a href="admin_orders_dashboard_page.html"><h3>Orders</h3></a>
            <a href="admin_products_dashboard_page.html"><h3>Products</h3></a>
            <a class="nav_end" href="../login_register/login_page.html"><h3>Log off</h3></a>
        </header>
        <main>
            <aside class="admin_order_info">
                <h4>Order ID: 1</h4>
                <h4>Customer shipping info:</h4>
                <span><p>Name: </p><p>bob</p></span>
                <span><p>Address: </p><p>123 dojo way</p></span>
                <span><p>City: </p><p>seattle</p></span>
                <span><p>State: </p><p>wa</p></span>
                <span><p>Zip: </p><p>98133</p></span>
                <h4>Customer billing info:</h4>
                <span><p>Name: </p><p>bob</p></span>
                <span><p>Address: </p><p>123 dojo way</p></span>
                <span><p>City: </p><p>seattle</p></span>
                <span><p>State: </p><p>wa</p></span>
                <span><p>Zip: </p><p>98133</p></span>
            </aside>
            <aside>
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
                        <tr>
                            <td>35</td>
                            <td>cup</td>
                            <td>$9.99</td>
                            <td>1</td>
                            <td>$9.99</td>
                        </tr>
                        <tr class="color1">
                            <td>215</td>
                            <td>shirt</td>
                            <td>$19.99</td>
                            <td>2</td>
                            <td>$39.98</td>
                        </tr>
                    </tbody>
                </table>
                <div class="admin_order_info_status">
                    <p class="shipped_color">Status: <span>shipped</span></p>
                    <aside>
                        <span><p>Sub total: </p><p>$29.98</p></span>
                        <span><p>Shipping: </p><p>$1.00</p></span>
                        <span><p>Total Price: </p><p>$30.98</p></span>
                    </aside>
                </div>
            </aside>
        </main>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>(Dashboard Orders)</title>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap-utilities.min.css" integrity="sha512-zaB1zReS2QONsLmpHDzDuNInQ7m4rswNiOXRWYkwxx3YDLz0AuryPJCbsWeoUM/7ZEOY0ZYXQdkei0Kac5gc1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="<?= base_url('assets/js/admin/orders_dashboard.js') ?>"></script>
    </head>
    <body>
        <div class="container-xl _container">
            <header class="d-flex align-items-center">
                <p class='me-3 fs-3 fw-bold'>Dashboard</p>
                <a href="<?= base_url('dashboard/orders') ?>" class="me-3"><h3>Orders</h3></a>
                <a href="<?= base_url('dashboard/products') ?>" class="me-3"><h3>Products</h3></a>
                <a class="btn-warning p-2 ms-auto" href="<?= base_url('users/logout') ?>">Log off</a>
            </header>
            <main>
                <p class="message_admin_orders"></p>
                <form class="form_admin_orders">
                    <input type="search" name="search" placeholder="Search" />
                    <select name="status">
                        <option value="">Show All</option>
                        <option value="1">Order in process</option>
                        <option value="2">Shipped</option>
                        <option value="3">Cancelled</option>
                    </select>
                </form>
                <div id="root"></div>
            </main>
        </div>

    </body>
</html>
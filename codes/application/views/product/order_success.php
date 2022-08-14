<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Carts Page) Shopping Cart | Lashopda</title>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <script>
        $(document).ready(function(){

            // $(document).on("submit", "form", function(){
                
            // });
        });
    </script>
</head>
<body>
    <header class="d-flex align-items-center">
        <a href="products_page.html"><h2>Izi PC</h2></a>
        <a class="ms-auto" href="cart_page.html"><h3>Shopping Cart (<span class="cart_quantity">4</span>)</h3></a>
        <a class="btn-warning p-2 ms-3" href="<?= base_url('users/logout') ?>">Logout</a>
    </header>
    <main>
        <div class="login_register_page">
            <h2>Order now in process!</h2>
        </div>
    </main>
</body>
</html>
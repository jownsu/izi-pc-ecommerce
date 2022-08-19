<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Order Success | Izi PC</title>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    </head>
    <body>
        <div class="container-xl _container">
            <header class="d-flex align-items-center">
                <a href="<?= base_url('products') ?>"><h2>Izi PC</h2></a>
                <a class="btn-warning p-2 ms-auto" href="<?= base_url('users/logout') ?>">Logout</a>
            </header>
            <main>
                <div class="login_register_page">
                    <h2>Order now in process!</h2>
                    <a href="<?= base_url('products') ?>" class="btn-primary px-3 py-2 mt-3">Go back</a>
                </div>
            </main>
        </div>
    </body>
</html>
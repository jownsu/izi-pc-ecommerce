<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Product Page) Tshirt | Izi PC</title>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <script src="<?= base_url('assets/js/product/item.js') ?>"></script>
</head>
<body>
    <div class="container-xl _container">
        <header class="d-flex align-items-center">
            <a href="products_page.html"><h2>Izi PC</h2></a>
            <a class="ms-auto" href="cart_page.html"><h3>Shopping Cart (<span class="cart_quantity">4</span>)</h3></a>
            <a class="btn-warning p-2 ms-3" href="<?= base_url('users/logout') ?>">Logout</a>
        </header>
        <main>
            <section class="item_panel">
                <a class="go_back btn-secondary p-2 mb-3" href="#" >Go Back</a>
                <div class="item_details">
                    <div class="row">
                        <div class="col col-md-4">
                            <aside class="img_section">
                            <img class="main_img" src="<?= base_url("{$this->product->img_path}/{$product['main_image']}") ?>" alt="<?= $product['name'] ?>"/>        
                            <section>
                                <img class="sub_img default_main_img" src="<?= base_url("{$this->product->img_path}/{$product['main_image']}") ?>" alt="<?= $product['name'] ?>"/>
<?php
                if(!empty($product['sub_images'])){
                    $sub_images = explode(',', $product['sub_images']);
                    foreach($sub_images as $sub_image){
?>
                                <img class="sub_img" src="<?= base_url("{$this->product->img_path}/$sub_image") ?>" alt="<?= $product['name'] ?>"/>
<?php
                    }
                }
?>
                            </section>
                        </aside>
                        </div>
                        <div class="col col-md-8">
                            <aside class="desc_section">
                                <h2><?= $product['name'] ?></h2>
                                <p><?= $product['description'] ?></p>

                                <div class="desc_section_footer">
                                    <p class="cart_price">&#8369;<span class="price"><?= $product['price'] ?></span></p>
                                    <form action="#" method="post">
                                        <input type="hidden" name="product_id" value="product_id"/>
                                        <input type="number" name="quantity" class="cart_quantity" value="1">
                                        <input type="submit" value="Buy" class="btn-primary px-3 py-2"/>
                                    </form>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
            <article class="similar_items_section">
                <h3>Similar Items</h3>
                <div class="py-4">
<?php
            if(!empty($similar_products)){
                foreach($similar_products as $product){
?>
                    <section class="products">
                        <a href="<?= base_url("products/show/{$product['id']}") ?>">
                            <img src="<?= base_url("{$this->product->img_path}/{$product['image']}") ?>" alt="<?= $product['name'] ?>"/>
                            <p class="product-price">&#8369;<?= $product['price'] ?></p>
                        </a>
                        <p class="product-name"><?= $product['name'] ?></p>
                    </section>
<?php
                }
            }

?>
                </div>
            </article>
        </main>
    </div>

</body>
</html>
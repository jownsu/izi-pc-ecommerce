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
                <a class="btn-secondary p-2 mb-3" href="">Go Back</a>
                <div class="item_details">
                    <aside class="img_section">
                        <img class="main_img" src="../../../application/views/assets/img/products/0/products.jpg" alt="T-shirt"/>        
                        <section>
                            <img class="sub_img" src="../../../application/views/assets/img/products/1/T-shirt.jpg" alt="T-shirt"/>
                            <img class="sub_img default_main_img" src="../../../application/views/assets/img/products/0/products.jpg" alt="T-shirt"/>
                            <img class="sub_img" src="../../../application/views/assets/img/products/2/Shorts.jpg" alt="T-shirt"/>
                            <img class="sub_img" src="../../../application/views/assets/img/products/3/Shoes.jpg" alt="T-shirt"/>
                        </section>
                    </aside>
                    <aside class="desc_section">
                        <h2>T-shirt</h2>
                        <p>Description about the product ... . . . . . . .   Description about the product ... Description about the product ... Description about the product ... Description about the product ... Description about the product ... Description about the product ... Description about the product ... Description</p>
                        <form action="" method="post">
                            <input type="hidden" name="product_id" value="product_id"/>
                            <input type="number" name="quantity" class="quantity">
                            <input type="submit" value="Buy" class="btn-primary px-3 py-2"/>
                        </form>
                    </aside>
                </div>
            </section>
            <article class="similar_items_section">
                <h3>Similar Items</h3>
                <section class="products">
                    <a href="../../../application/views/product/item_page.html">
                        <img src="../../../application/views/assets/img/products/0/products.jpg" alt="T-shirt"/>
                        <p class="product-price">$19.99</p>
                    </a>
                    <p class="product-name">T-shirt</p>
                </section>
                <section class="products">
                    <a href="../../../application/views/product/item_page.html">
                        <img src="../../../application/views/assets/img/products/0/products.jpg" alt="T-shirt"/>
                        <p class="product-price">$19.99</p>
                    </a>
                    <p class="product-name">T-shirt</p>
                </section>
                <section class="products">
                    <a href="../../../application/views/product/item_page.html">
                        <img src="../../../application/views/assets/img/products/0/products.jpg" alt="T-shirt"/>
                        <p class="product-price">$19.99</p>
                    </a>
                    <p class="product-name">T-shirt</p>
                </section>
                <section class="products">
                    <a href="../../../application/views/product/item_page.html">
                        <img src="../../../application/views/assets/img/products/0/products.jpg" alt="T-shirt"/>
                        <p class="product-price">$19.99</p>
                    </a>
                    <p class="product-name">T-shirt</p>
                </section>
                <section class="products">
                    <a href="../../../application/views/product/item_page.html">
                        <img src="../../../application/views/assets/img/products/0/products.jpg" alt="T-shirt"/>
                        <p class="product-price">$19.99</p>
                    </a>
                    <p class="product-name">T-shirt</p>
                </section>
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
            </article>
        </main>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Izi PC</title>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
        <script src="<?= base_url('assets/js/product/products.js') ?>"></script>
    </head>
    <body>
        <div class="container-xl _container">
            <header class="d-flex align-items-center">
                <a href="<?= base_url('products') ?>"><h2>Izi PC</h2></a>
                <a class="ms-auto" href="<?= base_url('carts') ?>"><h3>Shopping Cart (<span class="cart_count"><?= $cart_count ?></span>)</h3></a>
                <a class="btn-warning p-2 ms-3" href="<?= base_url('users/logout') ?>">Logout</a>
            </header>
            <main>
                <div class="row">
                    <div class="col col-md-3">
                        <aside class="category_panel">
                            <form id="search_form" action="<?= base_url('products/index_html') ?>" class="d-flex align-items-center">
                                <input type="search" name="name" placeholder="Product name" />
                                <button type="submit" class="btn-primary py-1 px-2 ms-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 17 17">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                    </svg>
                                </button>
                            </form>
                            <section class="products_categories">
                                <h4>Categories</h4>
<?php
            if(!empty($categories)){
                foreach($categories as $category){
?>
                                <a href="/" data-id="<?= $category['id'] ?>"><?= $category['name'] ?> (<?= $category['total_product'] ?>)</a>
<?php
                }
            }
?>
                                <a class="show_all_products" href="/">All Products</a>
                            </section>
                        </aside>
                    </div>
                    <div class="col col-md-9">
                        <article class="catalog">
                            <div class="subheader">
                                <h2><span class="category_name">All Products </span> ( page <span class="page_number">1</span> )</h2>
                                <section class="pagination_top">
                                    <a class="first_page" href="">first</a><!--
                                ---><a class="prev_page" href="">prev</a><!--
                                ---><p><span class="page_number">1</span></p><!--
                                ---><a class="next_page" href="">next</a>
                                </section>
                            </div>
                            <form id="order_form" action="<?= base_url('products/index_html') ?>" >
                                <label>Sorted by </label>
                                <select id="select_order" name="order">
                                    <option value="ASC">Price: Low to High</option>
                                    <option value="DESC">Price: High to Low</option>
                                    <!-- <option value="2">Most Popular</option> -->
                                </select>
                            </form>
                            <div class="products_container"></div>
                        </article>
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
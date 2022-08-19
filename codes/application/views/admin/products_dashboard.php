<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Products | Izi PC</title>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/jquery-ui.js') ?>"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap-utilities.min.css" integrity="sha512-zaB1zReS2QONsLmpHDzDuNInQ7m4rswNiOXRWYkwxx3YDLz0AuryPJCbsWeoUM/7ZEOY0ZYXQdkei0Kac5gc1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <script src="<?= base_url('assets/js/admin/products_dashboard.js') ?>"></script>
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
<?php
            if(!empty($error_msg)){
?>
                <div class="alert-error">
                    <?= $error_msg ?>
                </div>
<?php
            }
?>
<?php
            if(!empty($success_msg)){
?>
                <div class="alert-success">
                    <?= $success_msg ?>
                </div>
<?php
            }
?>
                <p class="message_admin_products"></p>
                <section class="form_admin_products">
                    <form class="form_admin_products_search" action="<?= base_url('products/index_html') ?>">
                        <input type="search" name="name" placeholder="Search by name" />
                    </form>
                    <button class="btn_add_product btn-primary px-3 py-2 d-block ms-auto" type="button">Add new product</button>
                </section>
                <div id="root"></div>
            </main>
        </div>


        <div class="admin_product_delete">
            <p>Are you sure you want to delete product "<span class="delete_product_name">Product Name</span>" (ID: <span class="delete_product_id">ID</span>)</p>
            <div class="d-flex justify-content-between">
                <form action="<?= base_url('products/delete') ?>" method="post">
                    <input type="hidden" class="csrf" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                    <input class="product_id" type="hidden" name="product_id" value=""/>
                    <input type="submit" value="Yes" class="btn-secondary py-2 px-3" />
                </form>
                <button type="button" class="btn-primary py-2 px-3">No</button>
            </div>
        </div>
        <div class="modal_bg_delete_product"></div>
        <div class="modal_bg"></div>
        <dialog class="admin_products_add_edit">
            <h2 class="add_edit_product_header">Edit Product - ID 0</h2>
            <button class="btn_close btn-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                    <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                </svg>
            </button>
            <form class="form_product_add_edit" action="<?= base_url('products/save') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                <p>Name: </p><input class="input_product_name" type="text" name="name"/>
                <p>Description: </p><textarea class="input_product_desc" name="description"></textarea>
                <p>Categories: </p>
                <input type="hidden" name="category_id" class="category_id" value="">
                <div class="select_tag_container">
                    <button class="dummy_select_tag" type="button"><span></span><span>&#9660;</span></button>
                    <ul class="product_categories">
                    </ul>
                </div>
                <p>or add new category: </p><input type="text" name="add_category"/>
                <p>Price: </p><input class="input_product_price" type="number" name="price" min="0.01" step="0.01"/>
                <p>Quantity (Inventory): </p><input class="input_product_qty" type="number" name="inventory"/>
                <p class="img_field_name">Images: </p><input id="img_upload" type="file" name="images[]" multiple accept=".png, .jpg, .jpeg" />
                <label class="file_upload_label btn-plain py-2 px-3" for="img_upload">Upload</label>
                <ul class="img_upload_container">
                </ul>
                <div class="products_add_edit_btn">
                    <button class="btn_cancel_products_add_edit btn-warning p-2" type="button">Cancel</button>
                    <!-- <button class="btn_preview_products_add_edit btn-secondary p-2 ms-2" type="button">Preview</button> -->
                    <input class="product_id" type="hidden" name="product_id" value=""/>
                    <input class="btn_submit_products_add_edit btn-primary p-2 ms-2" type="submit" value="Update" />
                </div>
            </form>
            <div class="bg_category_confirm_delete">
                <div class="category_confirm_delete">
                    <p>Are you sure you want to delete "<span class="category_name">Shirt</span>" category?</p>
                    <div class="d-flex justify-content-between">
                        <form action="<?= base_url('categories/delete') ?>" method="post">
                            <input type="hidden" class="csrf" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                            <input class="category_id" type="hidden" name="category_id" value=""/>
                            <input type="submit" value="Yes" class="btn-secondary py-2 px-3"/>
                        </form>
                        <button type="button" class="btn-warning py-2 px-3">No</button>
                    </div>
                </div>
            </div>
        </dialog>
    </body>
</html>
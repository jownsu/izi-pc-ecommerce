<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Izi PC</title>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <script src="<?= base_url('assets/js/product/cart.js') ?>"></script>
</head>
<body>
    <div class="container-xl _container">
        <header class="d-flex align-items-center">
            <a href="products_page.html"><h2>Izi PC</h2></a>
            <a class="ms-auto" href="cart_page.html"><h3>Shopping Cart (<span class="cart_quantity">4</span>)</h3></a>
            <a class="btn-warning p-2 ms-3" href="<?= base_url('users/logout') ?>">Logout</a>
        </header>
        <main>
            <section class="cart_table_section">
                <table class="cart_table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="color0">
                            <td>T-shirt</td>
                            <td>$19.99</td>
                            <td>
                                <span>3</span>
                                <a class="btn-plain p-2" href="item_page.html">update</a>
                                <form action="" method="post">
                                    <input type="hidden" name="product_id" value="product_id"/>
                                    <button class="btn-warning p-2 ms-md-1" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <td>$19.99</td>
                        </tr>
                        <tr class="color1">
                            <td>T-shirt</td>
                            <td>$19.99</td>
                            <td>
                                <span>1</span>
                                <a class="btn-plain p-2" href="item_page.html">update</a>
                                <form action="" method="post">
                                    <input type="hidden" name="product_id" value="product_id"/>
                                    <button class="btn-warning p-2 ms-1" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <td>$19.99</td>
                        </tr>
                    </tbody>
                </table>
                <section class="cart_total_section">
                    <h4>Total: <span class="cart_total_amount">$49.96</span></h4>
                    <p><a class="btn-secondary py-2 px-3" href="products_page.html">Continue Shopping</a></p>
                </section>
            </section>

            <div class="row">
                <div class="col col-md-6">
                    <form action="order_success.html" method="post" class="cart_billing_section">
                        <h2>Shipping Information</h2>
                        <span><p>First Name: </p><input type="text" name="first_name_ship"/></span>
                        <span><p>Last Name: </p><input type="text" name="last_name_ship"/></span>
                        <span><p>Address: </p><input type="text" name="address_ship"/></span>
                        <span><p>Address 2: </p><input type="text" name="address2_ship"/></span>
                        <span><p>City: </p><input type="text" name="city_ship"/></span>
                        <span><p>State: </p><input type="text" name="state_ship"/></span>
                        <span><p>Zipcode: </p><input type="number" name="zipcode_ship"/></span>
                    </form>
                </div>
                <div class="col col-md-6">
                    <form action="order_success.html" method="post" class="cart_billing_section">
                        <h2>Billing Information</h2>
                        <span>
                            <input id="billing_checkbox" type="checkbox" name="billing_info" value="same_shipping" />
                            <label for="billing_checkbox">Same as Shipping</label>
                        </span>
                        <span><p>First Name: </p><input type="text" name="first_name_bill"/></span>
                        <span><p>Last Name: </p><input type="text" name="last_name_bill"/></span>
                        <span><p>Address: </p><input type="text" name="address_bill"/></span>
                        <span><p>Address 2: </p><input type="text" name="address2_bill"/></span>
                        <span><p>City: </p><input type="text" name="city_bill"/></span>
                        <span><p>State: </p><input type="text" name="state_bill"/></span>
                        <span><p>Zipcode: </p><input type="number" name="zipcode_bill"/></span>
                        <span class="card_billing"><p>Card: </p><input type="number" name="card_number"/></span>
                        <span><p>Security Code: </p><input type="number" name="card_security"/></span>
                        <span class="card_exp">
                            <p>Expiration: </p><input type="number" name="card_exp_month" placeholder="(mm)"/>
                            <p>/</p><input type="number" name="card_exp_year" placeholder="(year)"/>
                        </span>
                        <input type="submit" value="Pay" class="btn-primary px-3  py-2 ms-auto d-block"/>
                    </form>
                </div>
            </div>


            </section>
        </main>
    </div>

</body>
</html>
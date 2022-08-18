<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopping Cart | Izi PC</title>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap-utilities.min.css" integrity="sha512-zaB1zReS2QONsLmpHDzDuNInQ7m4rswNiOXRWYkwxx3YDLz0AuryPJCbsWeoUM/7ZEOY0ZYXQdkei0Kac5gc1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js" integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css" integrity="sha512-8D+M+7Y6jVsEa7RD6Kv/Z7EImSpNpQllgaEIQAtqHcI0H6F4iZknRj0Nx1DCdB+TwBaS+702BGWYC0Ze2hpExQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="<?= base_url('assets/js/product/cart.js') ?>"></script>
    </head>
    <body>
        <div class="container-xl _container">
            <header class="d-flex align-items-center">
                <a href="<?= base_url('products') ?>"><h2>Izi PC</h2></a>
                <a class="ms-auto" href="<?= base_url('carts') ?>"><h3>Shopping Cart (<span class="cart_count"><?= count($cart) ?></span>)</h3></a>
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
<?php 
            if(!empty($cart)){
                $total_price = 0;
                foreach($cart as $product){
                    $total_price += $product['quantity'] * $product['price'];
?>
                            <tr>
                                <td><?= $product['name'] ?></td>
                                <td class="price">&#8369;<span><?= $product['price'] ?></span></td>
                                <td>
                                    <form action="<?= base_url('carts/update_cart') ?>" method="post" class="update_cart_form">
                                        <input class="csrf" type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                                        <input type="hidden" name="cart_id" value="<?= $product['id'] ?>"/>
                                        <input type="number" name="quantity" value="<?= $product['quantity'] ?>" class="quantity_input">
                                        <input type="submit" value="Update" class="btn-plain p-2">
                                    </form>
                                    <form action="<?= base_url('carts/remove_cart') ?>" method="post" class="remove_cart_form">
                                        <input class="csrf" type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                                        <input type="hidden" name="cart_id" value="<?= $product['id'] ?>"/>
                                        <button class="btn-warning p-2 ms-md-1" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                                <td class="total_price">&#8369;<span><?= $product['quantity'] * $product['price'] ?></span></td>
                            </tr>
<?php
                }
            }
?>
                        </tbody>
                    </table>
                    <section class="cart_total_section">
                        <div>
                            <p class="lbl">Shipping fee: </p>
                            <p class="val">&#8369;50</p>
                        </div>
                        <div>
                            <p class="lbl">Total: </p>
                            <p class="val">&#8369;<span class="cart_total_amount"><?= !empty($total_price) ? $total_price + 50 : 0 ?></span></p>
                        </div>
                    </section>
                    <a class="btn-secondary mt-3 py-2 px-3" href="<?= base_url('products') ?>">Continue Shopping</a>
                </section>
                <section>
<?php
    if(!empty($error_msg)){
?>
                    <div class="alert-error w-50 mx-auto">
                        <?= $error_msg ?>
                    </div>
<?php
    }
?>
                    <form action="<?= base_url('Orders/create') ?>" method="post" class="payment_form form-validation"  data-cc-on-file="false" data-stripe-publishable-key="<?= $this->config->item('stripe_key') ?>" id="payment-form">
                        <input type="hidden" class="csrf" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                        <div class="row">
                            <div class="col col-md-6">
<?php
                            if(!empty($shipping_error_msg)){
?>
                                <div class="alert-error w-75 mx-auto">
                                    <?= $shipping_error_msg ?>
                                </div>
<?php
                            }
?>
                                <div class="cart_billing_section">
                                    <h2>Shipping Information</h2>
                                    <span><p>First Name: </p><input type="text" name="s_first_name"/></span>
                                    <span><p>Last Name: </p><input type="text" name="s_last_name"/></span>
                                    <span><p>Address: </p><input type="text" name="s_address1"/></span>
                                    <span><p>Address 2: </p><input type="text" name="s_address2"/></span>
                                    <span><p>City: </p><input type="text" name="s_city"/></span>
                                    <span><p>State: </p><input type="text" name="s_state"/></span>
                                    <span><p>Zipcode: </p><input type="number" name="s_zipcode"/></span>
                                </div>
                            </div>
                            <div class="col col-md-6">
<?php
                            if(!empty($billing_error_msg)){
?>
                                <div class="alert-error w-75 mx-auto">
                                    <?= $billing_error_msg ?>
                                </div>
<?php
                            }
?>
                                <div class="cart_billing_section">
                                    <h2>Billing Information</h2>
                                    <span>
                                        <input id="billing_checkbox" type="checkbox" name="billing_info" value="same_shipping" />
                                        <label for="billing_checkbox">Same as Shipping</label>
                                    </span>
                                    <span><p>First Name: </p><input type="text" name="b_first_name"/></span>
                                    <span><p>Last Name: </p><input type="text" name="b_last_name"/></span>
                                    <span><p>Address: </p><input type="text" name="b_address1"/></span>
                                    <span><p>Address 2: </p><input type="text" name="b_address2"/></span>
                                    <span><p>City: </p><input type="text" name="b_city"/></span>
                                    <span><p>State: </p><input type="text" name="b_state"/></span>
                                    <span><p>Zipcode: </p><input type="number" name="b_zipcode"/></span>

                                    <span class="card_billing"><p>Card: </p><input type="text" class="card-number" name="b_card_number"/></span>
                                    <span><p>Cvc: </p><input type="number" class="card-cvc" name="b_card_security"/></span>
                                    <span class="card_exp">
                                        <p>Expiration: </p><input type="number" class="card-expiry-month" name="b_card_exp_month" placeholder="(mm)"/>
                                        <p>/</p><input type="number" class="card-expiry-year" name="b_card_exp_year" placeholder="(year)"/>
                                    </span>
                                    <input type="submit" value="Pay" class="btn-primary px-3  py-2 ms-auto d-block"/>
                                </div>
                            </div> 
                        </div>
                    </form>
                </section>
            </main>
        </div>

        <!-- STRIPE CODES -->
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script type="text/javascript">
            $(function () {
                var $stripeForm = $(".form-validation");
                $('form.form-validation').bind('submit', function (e) {
                    var $stripeForm = $(".form-validation"),
                        inputSelector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'
                        ].join(', '),
                        $inputs = $stripeForm.find('.required').find(inputSelector),
                        $errorMessage = $stripeForm.find('div.error'),
                        valid = true;
                    $errorMessage.addClass('hide');
                    $('.has-error').removeClass('has-error');
                    $inputs.each(function (i, el) {
                        var $input = $(el);
                        if ($input.val() === '') {
                            $input.parent().addClass('has-error');
                            $errorMessage.removeClass('hide');
                            e.preventDefault();
                        }
                    });
                    if (!$stripeForm.data('cc-on-file')) {
                        e.preventDefault();
                        Stripe.setPublishableKey($stripeForm.data('stripe-publishable-key'));
                        Stripe.createToken({
                            number: $('.card-number').val(),
                            cvc: $('.card-cvc').val(),
                            exp_month: $('.card-expiry-month').val(),
                            exp_year: $('.card-expiry-year').val()
                        }, stripeResponseHandler);
                    }
                });
                function stripeResponseHandler(status, res) {
                    if (res.error) {
                        console.log(res.error.message)
                        $.toast({
                            heading: 'Error',
                            text: res.error.message,
                            icon: 'error',
                            showHideTransition: 'slide',
                            position: 'bottom-right',
                            hideAfter: 5000, 
                        })
                        $.get('/orders/ajax_generate_csrf', function(res){
                            $('.csrf').val(res.csrf['hash'])
                            $('.csrf').attr('name', res.csrf['name'])
                        });

                        // $('.error')
                        //     .removeClass('hide')
                        //     .find('.alert')
                        //     .text(res.error.message);
                    } else {
                        var token = res['id'];
                        $stripeForm.find('input[type=text]').empty();
                        $stripeForm.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                        $stripeForm.get(0).submit();
                    }
                }
            });
        </script>
    </body>
</html>
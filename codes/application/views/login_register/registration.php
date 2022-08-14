<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izi PC | Register</title>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-utilities.min.css" integrity="sha512-V+uwL2kLYpr/Twxnl57MTxJf4rv3dqOmsTOtJLTq1TT1aWXinSsp89jLEafPt41OXc+Xs93rDtLR1d4Nnt5GxQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <script>
        // $(document).ready(function(){
        //     $(document).on("submit", "form", function(){
        //         window.location = "../../../application/views/admin/admin_orders_dashboard_page.html";
        //         return false;
        //     });
        // });
    </script>
</head>
<body>
    <div class="auth-form">
        <h1>Register</h1>
<?php
        if(!empty($error_msg)){
?>
            <?= $error_msg ?>
<?php
        }
?>
        <form action="<?= base_url('users/process_register') ?>" method="post">
            <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">

            <div class="mb-3">
                <label for="first_name" class="d-block">First name</label>
                <input type="first_name" class="form-control p-2" id="first_name" name="first_name" placeholder="First name">
            </div>
            <div class="mb-3">
                <label for="last_name" class="d-block">Last name</label>
                <input type="last_name" class="form-control p-2" id="last_name" name="last_name" placeholder="Last name">
            </div>
            <div class="mb-3">
                <label for="email" class="d-block">Email address</label>
                <input type="email" class="form-control p-2" id="email" name="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="contact_no" class="d-block">Contact number</label>
                <input type="contact_no" class="form-control p-2" id="contact_no" name="contact_no" placeholder="Contact number">
            </div>
            <div class="mb-3">
                <label for="password" class="d-block">Password</label>
                <input type="password" class="p-2" id="password" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="d-block">Confirm Password</label>
                <input type="password" class="p-2" id="confirm_password" name="confirm_password" placeholder="Confirm password">
            </div>
            <input type="submit" value="Register" class="btn-primary w-50 mb-3 py-2">
            <p>Already have an account? <a href="<?= base_url('login') ?>">Login</a></p>
        </form>
    </div>
</body>
</html>
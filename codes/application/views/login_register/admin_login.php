<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login Page | Izi PC</title>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" integrity="sha512-Aa+z1qgIG+Hv4H2W3EMl3btnnwTQRA47ZiSecYSkWavHUkBF2aPOIIvlvjLCsjapW1IfsGrEO3FU693ReouVTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap-utilities.min.css" integrity="sha512-V+uwL2kLYpr/Twxnl57MTxJf4rv3dqOmsTOtJLTq1TT1aWXinSsp89jLEafPt41OXc+Xs93rDtLR1d4Nnt5GxQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="<?= base_url('assets/css/normalize.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    </head>
    <body>

        <div class="auth-form">
            <h1>Admin Login</h1>
<?php
        if(!empty($error_msg)){
?>
            <div class="alert-error">
                <?= $error_msg ?>
            </div>
<?php
        }
?>
            <form action="<?= base_url('users/process_admin_login') ?>" method="post">
                <input type="hidden" name="<?= $csrf['name'] ?>" value="<?= $csrf['hash'] ?>">
                <div class="mb-3">
                    <label for="email" class="d-block">Email address</label>
                    <input type="email" class="form-control p-2" id="email" name="email" placeholder="Enter your Email">
                </div>
                <div class="mb-3">
                    <label for="password" class="d-block">Password</label>
                    <input type="password" class="p-2" id="password" name="password" placeholder="Enter your password">
                </div>
                <input type="submit" value="Login" class="btn-primary w-50 mb-3 py-2">
                <!-- <p>Don't have an account yet? <a href="registration_page.html">Register</a></p> -->
            </form>
        </div>
    </body>
</html>
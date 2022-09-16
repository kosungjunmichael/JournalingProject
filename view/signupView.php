<?php $title = "SignUp";?>
<?php $style = "signup" ?>
<?php ob_start();?>
    <div class="box">
        <form method="POST" action="<?=BASE. "/index.php?action=signup&page=regular"?>" class="signup">
            <span id="header-text">Sign Up</span>
            <div class="input-container">
                <input id="sign-u" type="text" required name="sign-u"/>
                <label for="sign-u">Username</label>
            </div>
            <div class="input-container">
                <input id="sign-e" type="email" required name="sign-e"/>
                <label for="sign-e">Email</label>
            </div>
            <div class="input-container">
                <input id="sign-p" type="password" required name="sign-p"/>
                <label for="sign-p">Password</label>
            </div>
            <div class="input-container">
                <input id="sign-cp" type="password" required name="sign-cp"/>
                <label for="sign-cp">Confirm Password</label>
            </div>
            <button id="signup-btn" type="submit">Sign Up</button>
        </form>
        <div id="or-separator">
            OR
        </div>
        <div id="g_id_onload"
             data-client_id="<?=$_SERVER['CLIENT_ID']?>"
             data-context="signup"
             data-ux_mode="popup"
             data-login_uri="http://localhost/sites/JournalingProject/index.php?action=signup&type=google"
             data-auto_prompt="false">
        </div>
        <div class="g_id_signin"
             data-type="standard"
             data-shape="rectangular"
             data-theme="outline"
             data-text="signup_with"
             data-size="large"
             data-logo_alignment="left">
        </div>
        <div id="form-bottom">
            <p>Already have an account?</p>
            <a id="login-link" href="<?=BASE. "/index.php?action=linkTo&page=toLogin"?>">Login</a>
        </div>
    </div>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>


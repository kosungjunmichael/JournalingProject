<?php $title = "SignUp";?>
<?php $style = "signup" ?>
<?php ob_start();?>
    <div class="box">
        <form method="POST" action="../index.php?action=signup&type=regular" class="signup">
            <span class="text-center">Sign Up</span>
        <div class="input-container">
            <input type="text" name="sign-u"/>
            <label>Username</label>		
        </div>
        <div class="input-container">
            <input type="text" name="sign-e"/>
            <label>Email</label>
        </div>
        <div class="input-container">		
            <input type="mail" name="sign-p"/>
            <label>Password</label>
        </div>
        <div class="input-container">		
            <input type="mail" name="sign-cp"/>
            <label>Confirm Password</label>
        </div>
            <button type="button" class="btn">Log In</button>
            <input type="submit" value="Sign Up">
        </form>
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
    </div>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>


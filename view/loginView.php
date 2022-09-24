<?php $title = "DearDiary - Log In";?>
<?php $style = "login" ?>
<?php $script = "script";?>

<?php ob_start();?>

    <!-- login -->

    <div class="box">
        <?php if (isset($error)){ echo "<span id='login-error'>" . $error . "</span>"; } ?>
        <form method="POST" action="<?=BASE. "/index.php?action=regularLogin"?>" class="signin">
            <span id="header-text">Login</span>
            <div class="input-container">
                <input id="login-ue" type="text" required name="login-ue" <?php if(isset($username)) {echo "value='" . $username . "'";}?> />
                <label for="login-ue" >Username / Email</label>
            </div>
            <div class="input-container">
                <input id="login-p" type="password" required name="login-p"/>
                <label for="login-p">Password</label>
            </div>
            <button type="submit" id="login-btn">Log In</button>
        </form>
        <div id="or-separator">
            OR
        </div>
        <div id="g_id_onload"
            data-client_id="<?=$_SERVER['CLIENT_ID']?>"
            data-context="signin"
            data-login_uri="http://localhost/sites/JournalingProject/index.php?action=googleLogin"
            data-auto_prompt="false">
        </div>
        <div class="g_id_signin"
            data-type="standard"
            data-size="large"
            data-theme="outline"
            data-text="sign_in_with"
            data-shape="circle"
            data-logo_alignment="left">
        </div>
        <div id="form-bottom">
            <p>Don't have an account yet?</p>
            <a id="sign-up-link" href="<?=BASE. "/index.php?action=toSignup"?>">Sign Up</a>
        </div>
    </div>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>
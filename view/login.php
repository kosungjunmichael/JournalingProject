<?php $title = "Log In";?>
<?php $style = "login" ?>
<?php ob_start();?>
<!-- dark mode -->
    <div type="checkbox" id="darkMode" class="darkMode">Toggle</div>
    <label for="darkMode">
<!-- login -->
    <div class="box">
        <form method="POST" action="signin.php" class="signin">
            <span class="text-center">Login</span>
            <div class="input-container">
                <input type="text" required name="login-ue"/>
                <label>Username / Email</label>
            </div>
            <div class="input-container">
                <input type="password" required name="login-p"/>
                <label>Password</label>
            </div>
            <button type="submit" class="btn">Log In</button>
            <!-- signup button -->
            <a href="signup.php" class="btn">Sign Up</a>
        </form>	
        <div id="g_id_onload"
            data-client_id="<?=$_SERVER['CLIENT_ID']?>"
            data-login_uri="http://localhost/sites/JournalingProject/index.php?action=login&type=google"
            data-auto_prompt="false">
        </div>
        <div class="g_id_signin"
            data-type="standard"
            data-size="large"
            data-theme="outline"
            data-text="sign_in_with"
            data-shape="rectangular"
            data-logo_alignment="left">
        </div>
    </div>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
<?php $title = "Log In";?>
<?php ob_start();?>
    <div class="background">
        <div class="shape"></div>
        <div class="shape2"></div>
        <div class="shape3"></div>
        <div class="shape4"></div>
    </div>  
    <form method="POST" action="testEntry.php" class="signin">
        <h3>Login</h3>
        <input name="username" type="text" placeholder="Username" id="username" required>
        <input name="password" type="password" placeholder="Password" id="password" required>
        <button>Log In</button>
        <a href="index2.php" class="button2">Sign Up</a>
    </form>
    <div id="g_id_onload"
    data-client_id="1065030075784-mk1j1m4oqq553ih7dppecedpg1ir59nl.apps.googleusercontent.com"
    data-login_uri="http://localhost/sites/JournalingProject/view/login.php"
    data-callback="handleCredentialResponse"
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
    <script src="https://accounts.google.com/gsi/client" async defer></script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
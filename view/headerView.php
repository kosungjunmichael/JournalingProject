<nav>
    <h2 style="color:white;"><a href="<?=BASE."/index.php?action=toLanding"?>" class="logo">Dear Diary</a></h2>
    <ul class="navbar">
        <li><a href="./index.php?action=toAboutUs">About us</a></li>
        <li><a href="#" data-target="#login" data-toggle="modal" class="btn" >Login</a></li>
        <li><a href="#"data-target="#signup" data-toggle="modal" class="btn1" >Signup</a></li>
    </ul>
</nav>
<div id="login" class="modal fade" role="dialog">
    <div class="box">
        <?php if (isset($error)){ echo "<span id='login-error'>" . $error . "</span>"; } ?>
        <button data-close="modal" id="close" class="close"> <p>X</p></button>
        <form method="POST" action="<?=BASE. "/index.php?action=login&type=regular"?>" class="signin">
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
        <div id="form-bottom">
            <p>Don't have an account yet?</p>
            <a id="sign-up-link">Sign Up</a>
        </div>
    </div>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</div>


<div id="signup" class="modal fade" role="dialog">
    <div class="box" style="width:450px;">
        <button data-close="modal" id="close1" class="close"> <p>X</p></button>
        <form method="POST" action="<?=BASE. "/index.php?action=signup&type=regular"?>" class="signup" style="width:390px;">
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
                <label for="sign-p">Password</label>
                <input type="password" id="psw" name="sign-p" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                title="Must contain at least one number and one uppercase and lowercase letter, and at 
                least 8 or more characters" required>
            </div>
            <div class="input-container">
                <input id="sign-cp" type="password" required name="sign-cp"/>
                <label for="sign-cp">Confirm Password</label>
            </div>
            <button id="signup-btn" type="submit">Sign Up</button>
        </form>
        <div id="message">
        <h3>Password must contain the following:</h3>
            <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
            <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
            <p id="number" class="invalid">A <b>number</b></p>
            <p id="length" class="invalid">Minimum <b>8 characters</b></p>
        </div>
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
            <a id="login-link" href="<?=BASE. "/index.php?action=toLogin"?>">Log In</a>
        </div>
    </div>
</div>
<div class="blur"></div>
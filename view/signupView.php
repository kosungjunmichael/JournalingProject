<?php $title = "SignUp";?>
<?php $style = "signup" ?>
<?php $script = "script";?>

<?php ob_start();?>
<!-- <?php if(isset($error)){
        echo $error;
    }?> -->
    <?php if (isset($error)){ echo "<span id='login-error'>" . $error . "</span>"; } ?>
    <?php if (isset($username)){ echo "<span id='login-error'>Username: " . $username . "</span>"; } ?>
    <?php if (isset($email)){ echo "<span id='login-error'>Email: " . $email . "</span>"; } ?>
    <div class="box">
        <form method="POST" action="<?=BASE. "/index.php?action=regularSignup"?>" class="signup">
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
                <div id="message">
                <h3>Password must contain the following:</h3>
                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                    <p id="number" class="invalid">A <b>number</b></p>
                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                </div>
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
            data-ux_mode="popup"
            data-context="signup"
            data-login_uri="http://localhost/sites/JournalingProject/index.php?action=googleSignup"
            data-auto_prompt="false">
        </div>
        <div class="g_id_signin"
            data-type="standard"
            data-shape="pill"
            data-theme="outline"
            data-text="signup_with"
            data-size="large"
            data-logo_alignment="left">
        </div>
        <div id="form-bottom">
            <p>Already have an account?</p>
            <a id="login-link" href="<?=BASE. "/index.php?action=toLogin"?>">Login</a>
        </div>
    </div>
    <!-- <script src="../public/js/passwordValidation.js"></script> -->
<script>
    var myInput = document.getElementById("psw");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
    // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {  
        letter.classList.remove("invalid");
        letter.classList.add("valid");
    } else {
        letter.classList.remove("valid");
        letter.classList.add("invalid");
    }


    var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {  
        capital.classList.remove("invalid");
        capital.classList.add("valid");
    } else {
        capital.classList.remove("valid");
        capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if(myInput.value.match(numbers)) {  
        number.classList.remove("invalid");
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
        number.classList.add("invalid");
    }
    
    // Validate length
    if(myInput.value.length >= 8) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
    }
</script>


<script src="https://accounts.google.com/gsi/client" async defer></script>
<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>


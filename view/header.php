<header>
    <nav>
        <h2><a href="<?=BASE."/index.php?action=toLanding"?>" class="logo">Dear Diary</a></h2>
        <ul class="navbar">
            <li><a href="<?=BASE."/index.php?action=toAboutUs"?>">About us</a></li>
            <li><a href="#" data-target="#login" data-toggle="modal" class="btn" >Login</a></li>
            <li><a href="#"data-target="#signup" data-toggle="modal" class="btn1" >Signup</a></li>
        </ul>
    </nav>
<div id="login" class="modal fade" role="dialog">
    <div class="box">
    <?php if (isset($error)){ echo "<span id='login-error'>" . $error . "</span>"; } ?>
            <button data-close="modal" id="close" class="close"><p><i class="fa-solid fa-circle-xmark"></i></p></button>
            <form method="POST" action="<?=BASE. "/index.php?action=regularlogin"?>" class="signin">
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
                data-login_uri="http://localhost/sites/JournalingProject/index.php?action=googleLogin"
                data-auto_prompt="false">
            </div>
            <div class="g_id_signin"
                data-type="standard"
                data-size="large"
                data-theme="outline"
                data-text="sign_in_with"
                data-shape="pill"
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
        <div class="box">
            <?php if (isset($error)){ echo "<span id='login-error'>" . $error . "</span>"; } ?>
            <button data-close="modal" id="close1" class="close"> <p><i class="fa-solid fa-circle-xmark"></i></p></button>
            <form method="POST" action="<?=BASE. "/index.php?action=regularSignup"?>" class="signin">
                <span id="header-text">Sign Up</span>
                <div class="input-container">
                    <input 
                    type="text" 
                    name="sign-u" <?php if(isset($username)) {echo "value='" . $username . "'";}?> />
                    <label for="sign-u">Username</label>
                </div>
                <div class="input-container">
                    <input 
                    type="text" 
                    name="sign-e" <?php if(isset($username)) {echo "value='" . $username . "'";}?> />
                    <label for="sign-e">Email</label>
                </div>
                <div class="input-container">
                    <input 
                    id="login-p" 
                    type="password" 
                    name="sign-p"/>
                    <label for="sign-p">Password</label>
                </div>
                <div class="input-container">
                    <input id="login-p" type="password" required name="sign-cp"/>
                    <label for="sign-cp">Confirm Password</label>
                </div>
                <button type="submit" id="login-btn">Sign Up</button>
            </form>
            <div id="or-separator">
                OR
            </div>
            <div id="g_id_onload"
                data-client_id="<?=$_SERVER['CLIENT_ID']?>"
                data-login_uri="http://localhost/sites/JournalingProject/index.php?action=googleSignup"
                data-auto_prompt="false">
            </div>
            <div class="g_id_signin"
                data-type="standard"
                data-size="large"
                data-theme="outline"
                data-text="sign_in_with"
                data-shape="pill"
                data-logo_alignment="left">
            </div>
        </div>
        <script src="https://accounts.google.com/gsi/client" async defer></script>
    </div>
    <div class="blur"></div>
</header>

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
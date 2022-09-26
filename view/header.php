<header>
    <nav>
        <h2><a href="<?= BASE . "/index.php?action=toLanding" ?>" class="logo">Dear Diary</a></h2>
        <ul class="navbar">
            <li><a href="<?= BASE . "/index.php?action=toAboutUs" ?>">About us</a></li>
            <li><a href="#" data-target="#login" data-toggle="modal" class="btn">Login</a></li>
            <li><a href="#" data-target="#signup" data-toggle="modal" class="btn1">Signup</a></li>
        </ul>

    <div id="login" class="modal fade" role="dialog">
        <div class="box">
            <?php if (isset($error)) {
                echo "<span id='login-error'>" . $error . "</span>";
            } ?>
            <button data-close="modal" id="close" class="close">
                <p><i class="fa-solid fa-circle-xmark"></i></p>
            </button>
            
<!-- Sign In form -->

            <form method="POST" action="<?= BASE . "/index.php?action=regularogin" ?>" class="signin">
                <span id="header-text">Login</span>

                <div class="input-container">
                    <input 
                    id="login-ue" 
                    type="text" 
                    name="login-ue" 
                    <?php if(isset($username)) {echo "value='" . $username . "'";}?> 
                    />
                    <label 
                    for="login-ue" 
                    class="label" >Username / Email</label>

                </div>

                <div class="input-container">
                    <input 
                    id="login-p" 
                    type="password"
                    name="login-p" />
                    <label 
                    for="login-p"
                    class="label">Password</label>
                </div>

                <button type="submit" class="form-button" id="login-btn">Log In</button>

            </form>
            <div id="or-separator">
                OR
            </div>
            <div id="g_id_onload" data-client_id="<?= $_SERVER['CLIENT_ID'] ?>" data-login_uri="http://localhost/sites/JournalingProject/index.php?action=googleLogin" data-auto_prompt="false">
            </div>
            <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="pill" data-logo_alignment="left"></div>
            <div id="or-separator">
                OR
            </div>
            <div>
                <a id="kakao-login-btn" href="javascript:loginWithKakao()">
                    <img src="https://k.kakaocdn.net/14/dn/btroDszwNrM/I6efHub1SN5KCJqLm1Ovx1/o.jpg" width="222" alt="Kakao login button" />
                </a>
            </div>
            
            <a href="http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp">
                <button class="form-button">Kakao</button>
            </a>
            <div id="form-bottom">
                <p>Don't have an account yet?</p>
                <a id="sign-up-link">Sign Up</a>
            </div>

        </div>

        <!-- <script src="https://developers.kakao.com/sdk/js/kakao.js"></script> -->
        <!-- <script src="../public/js/kakao.js" async defer></script> -->
        <script src="https://accounts.google.com/gsi/client" async defer></script>
    </div>

    <!-- Sign Up form -->

    <div id="signup" class="modal fade" role="dialog">
        <div class="box">

        <?php if (isset($error)){ echo "<span id='login-error'>" . $error . "</span>"; } ?>
        <button data-close="modal" id="close1" class="close"> <p><i class="fa-solid fa-circle-xmark"></i></p></button>

        <form method="POST" action="<?=BASE. "/index.php?action=regularSignup"?>" class="signup" id="su-form">
            <span id="header-text">Sign Up</span>

            <div class="input-container">
                <input 
                id="sign-u"
                type="text" 
                name="sign-u" />
                <label 
                for="sign-u"
                class="label">Username</label>
                <div class="error-msg" id="tooltip-u">
                    <div class="arrow-left"></div>
                    <p>✖ Username can't be less than 4 characters</p>
                </div>
            </div>

            <div class="input-container">
                <input 
                id="sign-e" 
                type="text" 
                name="sign-e" />
                <label 
                for="sign-e"
                class="label">Email</label>
                <div class="error-msg" id="tooltip-e">
                    <div class="arrow-left"></div>
                    <p>✖ Please enter a valid Email Address</p>
                </div>
            </div>

            <div class="input-container">
                <input 
                type="password" 
                id="sign-p" 
                name="sign-p" />
                <!-- <div class="svg-container eye" id="su-pwd-show">
                    <i class="fa-solid fa-eye" id="togglePsw"></i>
                </div> -->
                <label 
                for="sign-p"
                class="label">Password</label>
                <div class="error-msg" id="tooltip-psw">
                    <div class="arrow-left"></div>
                    <p>✖ Please enter a valid Password</p>
                </div>

                <div id="tooltip-p">
                    <div class="arrow-left"></div>
                    <div id="message">
                        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                        <p id="capital" class="invalid">A <b>capital</b> letter</p>
                        <p id="number" class="invalid">A <b>number</b></p>
                        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                    </div>
                </div>
            </div>
            <div class="input-container">
                <input 
                id="sign-cp" 
                type="password" 
                name="sign-cp"/>
                <!-- <div class="svg-container eye" id="su-pwd2-show">
                    <i class="fa-solid fa-eye" id="togglePsw2"></i>
                </div> -->
                <label 
                for="sign-cp"
                class="label">Confirm Password</label>
                <div class="error-msg" id="tooltip-cp">
                    <div class="arrow-left"></div>
                    <p>✖ Please match with the above password</p>
                </div>
            </div>

            <input type="submit" class="form-button" id="signup-btn">Sign Up</button>
        </form>

        <div id="or-separator">
                OR
        </div>
        <!-- Google login -->
        <div class="google-btn">
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
        <div class="center-button">
            <a href="http://localhost/sites/JournalingProject/index.php/?action=kakaoLogin">
                <button class="form-button">Kakao</button>
            </a>
        </div>
    </div>
            <!-- <div id="g_id_onload" data-client_id="<?= $_SERVER['CLIENT_ID'] ?>" data-login_uri="http://localhost/sites/JournalingProject/index.php?action=googleLogin" data-auto_prompt="false">
            </div> -->
            <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="pill" data-logo_alignment="left"></div>
        </div>
        <div class="blur"></div>
</header>

<script>

// === Toggle to show password ===
// const togglePsw = document.getElementById("su-pwd-show");
// const pswToggle = document.querySelector(".input-field i#togglePsw");
// const su_pwd = document.getElementById("su-pwd1");

// togglePsw.addEventListener("click", () => {
//     if (pswToggle.classList.contains("fa-eye")) {
//         pswToggle.classList.remove("fa-eye");
//         pswToggle.classList.add("fa-eye-slash");
//     } else {
//         pswToggle.classList.remove("fa-eye-slash");
//         pswToggle.classList.add("fa-eye");
//     }
//     const type =
//     su_pwd.getAttribute("type") === "password" ? "text" : "password";
//     su_pwd.setAttribute("type", type);
//     togglePsw.innerHTML = "";
//     togglePsw.appendChild(pswToggle);
// });

// const togglePsw2 = document.getElementById("su-pwd2-show");
// const pwd2Toggle = document.querySelector(".input-field i#togglePsw2");
// const su_pwd2_inp = document.getElementById("su-pwd2");

// togglePsw2.addEventListener("click", () => {
//     if (pwd2Toggle.classList.contains("fa-eye")) {
//         pwd2Toggle.classList.remove("fa-eye");
//         pwd2Toggle.classList.add("fa-eye-slash");
//     } else {
//         pwd2Toggle.classList.remove("fa-eye-slash");
//         pwd2Toggle.classList.add("fa-eye");
//     }
//     const type2 =
//     su_pwd2_inp.getAttribute("type") === "password" ? "text" : "password";
//     su_pwd2_inp.setAttribute("type", type2);
//     togglePsw2.innerHTML = "";
//     togglePsw2.appendChild(pwd2Toggle);
// });

// const togglePswSi = document.getElementById("si-pwd-show");
// const pwdSiToggle = document.querySelector(".input-field i#togglePswSi");
// const si_pwd = document.getElementById("si-pwd");

// togglePswSi.addEventListener("click", () => {
//     if (pwdSiToggle.classList.contains("fa-eye")) {
//         pwdSiToggle.classList.remove("fa-eye");
//         pwdSiToggle.classList.add("fa-eye-slash");
//     } else {
//         pwdSiToggle.classList.remove("fa-eye-slash");
//         pwdSiToggle.classList.add("fa-eye");
//     }
//     const typeSi =
//     si_pwd.getAttribute("type") === "password" ? "text" : "password";
//     si_pwd.setAttribute("type", typeSi);
//     togglePswSi.innerHTML = "";
//     togglePswSi.appendChild(pwdSiToggle);
// });
    
// ==== Regex ====
    var regName = /^[a-zA-Z0-9]{4,}/;
    var regMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var regPsw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/;

// === Validate Username ===

let user = document.getElementById('sign-u');
let error_user = document.getElementById('tooltip-u');

function checkUser() {
    if (regName.test(user.value)) {
        error_user.style.display = "none";
        return true;
    } else {
        error_user.style.display = "block";
        return false;
    }
};

// === Validate E-mail ===

let mail = document.getElementById('sign-e');
let error_mail = document.getElementById('tooltip-e');

function checkMail() {
    if (regMail.test(mail.value)) {
        error_mail.style.display = "none";
        return true;
    } else {
        error_mail.style.display = "block";
        return false;
    }
};

// // === Validate Password ===

let psw = document.getElementById('sign-p');
let cp = document.getElementById('sign-cp');
let error_p = document.getElementById('tooltip-psw');
let error_cp = document.getElementById('tooltip-cp');

function checkPsw() {
    if (regPsw.test(psw.value)) {
        error_p.style.display = "none";
        return true;
    } else {
        error_p.style.display = "block";
    // === Show Password tooltip ===
    var myInput = document.getElementById("sign-p");
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
        if (myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }


        var upperCaseLetters = /[A-Z]/g;
        if (myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if (myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        // Validate length
        if (myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
        return false;
    }
};

function checkCP() {
    if (psw.value == cp.value) {
        error_cp.style.display = "none";
        return true;
    } else {
        error_cp.style.display = "block";
        return false;
    }
};

// === Event listeners on Key up ===
user.addEventListener('keyup', checkUser);
mail.addEventListener('keyup', checkMail);
psw.addEventListener('keyup', checkPsw);
cp.addEventListener('keyup', checkCP);

// ==== Submit =====

const su_form = document.getElementById('su-form');

su_form.addEventListener("submit", function(e) {
    let errorUser =  checkUser(true);
    let errorMail =  checkMail(true);
    let errorPsw =  checkPsw(true);
    let errorCP =  checkCP(true);
    if (
        errorUser &&
        errorMail &&
        errorPsw &&
        errorCP 
    ) {
        su_form.submit();
    } else {
        e.preventDefault();
    }
});

</script>

<script src="https://accounts.google.com/gsi/client" async defer></script>




<!-- KAKAO -->
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>

<script>
    Kakao.init("<?= $_SERVER['JS_API_KEY'] ?>"); // Enter your app's JavaScript key
    function loginWithKakao() {
        Kakao.Auth.login({
            success: function(authObj) {
                Kakao.Auth.setAccessToken(authObj.access_token);

                getInfo();
            },
            fail: function(err) {
                console.log(err);
            }
        });
    }

    function getInfo() {
        Kakao.API.request({
            url: '/v2/user/me',
            success: function(res) {
                console.log(res);
                // console.log(res);
                console.log(res.kakao_account.email);
                console.log(res.kakao_account.profile.nickname);
                console.log(res.kakao_account.profile.thumbnail_image_url)
                let email = res.kakao_account.email;
                // let gender = res.kakao_account.gender;
                // let nickname = res.kakao_account.profile.nickname;
                // let profile_image = res.kakao_account.profile.thumbnail_image_url;

                // console.log(email, gender, nickname, profile_image);
                // console.log(email, nickname, profile_image);

                window.location.href = `http://localhost/sites/JournalingProject/index.php/?action=kakaoSignUp&email=${res.kakao_account.email}`;
                // return res;
            },
            fail: function(error) {
                alert(JSON.stringify(error));
            }
        })
    }
</script>
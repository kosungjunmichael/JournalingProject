<header>
    <nav>
        <h2>
            <a href="<?= BASE . "/index.php?action=toLanding" ?>" class="logo">
                <div class="logonav-container">
                    <svg class="logo-img" width="33" height="40" viewBox="0 0 33 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path class="logo-svg-box" d="M7 7H32V37C32 38.1046 31.1046 39 30 39H7V7Z" fill="#fff" />
                        <path d="M7 7H32V37C32 38.1046 31.1046 39 30 39H7V7Z" stroke="#9673F5" stroke-width="2" />
                        <rect class="logo-svg-box" x="4" y="4" width="25" height="32" fill="#fff" />
                        <rect x="4" y="4" width="25" height="32" stroke="#9673F5" stroke-width="2" />
                        <rect class="logo-svg-box" x="1" y="1" width="25" height="32" fill="#fff" />
                        <rect x="1" y="1" width="25" height="32" stroke="#9673F5" stroke-width="2" />
                        <line x1="0.707107" y1="33.2929" x2="6.70711" y2="39.2929" stroke="#9673F5" stroke-width="2" />
                        <line x1="0.707107" y1="32.2929" x2="6.70711" y2="38.2929" stroke="#9673F5" stroke-width="2" />
                    </svg>
                    <div class="logo-title">
                        Dear Diary
                    </div>
                </div>
            </a>
        </h2>
        <ul class="navbar">
            <li><a href="<?= BASE .
            	"/index.php?action=toAboutUs" ?>">About us</a></li>
            <li><a href="#" data-target="#login" data-toggle="modal" class="btn">Login</a></li>
            <li><a href="#" data-target="#signup" data-toggle="modal" class="btn1">Signup</a></li>
        </ul>
    </nav>
    <!-- 
    ---------------------------------------------------------------------------
    -------------------------------Login---------------------------------------
    ---------------------------------------------------------------------------
     -->

    <div id="login" class="modal fade" role="dialog">
        <div class="box">
            <button data-close="modal" id="close" class="close">
                <p><i class="fa-solid fa-circle-xmark"></i></p>
            </button>

            <!-- Sign In form -->

            <form method="POST" action="<?= htmlspecialchars(
            	BASE . "/index.php?action=regularLogin"
            ) ?>" class="signin">
                <span id="header-text">Login</span>

                <!-- Back-end Error Notification -->

                <?php if (isset($error_login)) { ?>
                    <script>
                        alert("<?= htmlspecialchars($error_login) ?>")
                    </script>
                <?php } ?>

                <div id="form-bottom">
                    <p>Don't have an account yet?</p>
                    <a id="sign-up-link">Sign Up</a>
                </div>

                <div class="input-container">
                    <input id="login-ue" type="text" name="login-ue" <?php if (
                    	isset($username)
                    ) {
                    	echo "value='" . htmlspecialchars($username) . "'";
                    } ?> />
                    <label for="login-ue" class="label">Username / Email</label>
                </div>

                <div class="input-container">
                    <input type="password" id="login-p" name="login-p" />
                    <div class="svg-container eye" id="si-pwd-show">
                        <i class="fa-solid fa-eye" id="togglePswSi"></i>
                    </div>
                    <label for="login-p" class="label">Password</label>
                </div>

                <button type="submit" class="form-button" id="login-btn">Log In</button>
            </form>
            <div id="or-separator">OR</div>

            <!-- Google Login -->

            <div class="google-btn">
                <div id="g_id_onload" data-client_id="<?= $_SERVER[
                	"CLIENT_ID"
                ] ?>" data-login_uri="http://localhost/sites/JournalingProject/index.php?action=googleAccount" data-auto_prompt="false"></div>
                <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="sign_in_with" data-shape="pill" data-logo_alignment="left"></div>
            </div>

            <!-- Kakao Login -->

            <div id="kakao-login-container">
                <a id="kakao-login-btn" href="javascript:loginWithKakao()">
                    <div class="kakao-container">
                        <div class="kakao-symbol">
                            <i class="fa-solid fa-comment"></i>
                        </div>
                        <div class="kakao-label">
                            Login with Kakao
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- 
    ---------------------------------------------------------------------------
    -------------------------------Sign Up-------------------------------------
    ---------------------------------------------------------------------------
     -->

    <div id="signup" class="modal fade" role="dialog">
        <div class="box">
            <button data-close="modal" id="close1" class="close">
                <p><i class="fa-solid fa-circle-xmark"></i></p>
            </button>

            <!-- Sign Up form -->

            <form method="POST" action="<?= htmlspecialchars(
            	// BASE . "/index.php?action=signUp&method=regular"
            	BASE . "/index.php?action=regularSignUp"
            ) ?>" class="signup" id="su-form">
                <span id="header-text">Sign Up</span>

                <!-- Back-end Error Notification -->

                <?php if (isset($error_signup)) { ?>
                    <script>
                        alert("<?= htmlspecialchars($error_signup) ?>")
                    </script>
                <?php } ?>

                <div id="form-bottom">
                    <p>Already have an account?</p>
                    <a id="sign-in-link">Sign In</a>
                </div>

                <div class="input-container">
                    <input id="sign-u" type="text" name="sign-u" />
                    <label for="sign-u" class="label">Username</label>
                    <div class="error-msg" id="tooltip-u">
                        <div class="arrow-left"></div>
                        <p>✖ Username can't be less than 4 characters</p>
                    </div>
                </div>

                <div class="input-container">
                    <input id="sign-e" type="text" name="sign-e" />
                    <label for="sign-e" class="label">Email</label>
                    <div class="error-msg" id="tooltip-e">
                        <div class="arrow-left"></div>
                        <p>✖ Please enter a valid Email Address</p>
                    </div>
                </div>

                <div class="input-container">
                    <input type="password" id="sign-p" name="sign-p" />
                    <div class="svg-container eye" id="su-pwd-show">
                        <i class="fa-solid fa-eye" id="togglePsw"></i>
                    </div>
                    <label for="sign-p" class="label">Password</label>
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
                    <input type="password" id="sign-cp" name="sign-cp" />
                    <div class="svg-container eye" id="su-pwd2-show">
                        <i class="fa-solid fa-eye" id="togglePsw2"></i>
                    </div>
                    <label for="sign-cp" class="label">Confirm Password</label>
                    <div class="error-msg" id="tooltip-cp">
                        <div class="arrow-left"></div>
                        <p>✖ Please match with the above password</p>
                    </div>
                </div>

                <button type="submit" class="form-button" id="signup-btn">Sign Up</button>
            </form>

            <div id="or-separator">OR</div>

            <!-- Google Signup -->

            <div class="google-btn">
                <!-- <div id="g_id_onload" data-client_id="<?= $_SERVER[
                	"CLIENT_ID"
                ] ?>" data-login_uri="http://localhost/sites/JournalingProject/index.php?action=signup&method=google" data-auto_prompt="false"></div> -->
                <div class="g_id_signin" data-type="standard" data-size="large" data-theme="outline" data-text="signup_with" data-shape="pill" data-logo_alignment="left"></div>
            </div>

            <!-- Kakao Signup -->

            <a href="javascript:signUpWithKakao()">
                <div id="kakao-signup-container">
                    <div class="kakao-container">
                        <div class="kakao-symbol">
                            <i class="fa-solid fa-comment"></i>
                        </div>
                        <div class="kakao-label">
                            Signup with Kakao
                        </div>
                    </div>
                </div>
        </div>
        </a>

    </div>
    <div class="blur"></div>
</header>

<!-- FORM VALIDATION -->
<script src="<?= BASE . "/public/js/formValidation.js" ?>"></script>

<!-- BLUR -->
<script src="<?= BASE . "/public/js/loginSignup.js" ?>"></script>

<!-- GOOGLE -->
<script src="https://accounts.google.com/gsi/client" async defer></script>

<!-- KAKAO -->
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script>Kakao.init("<?= $_SERVER["JS_API_KEY"] ?>");</script>
<script src="<?= BASE . "/public/js/kakao.js" ?>"></script>
<?php $title = "Journey"; ?>
<?php $style = "journey" ?>

<?php ob_start(); ?>
<div class="container">
    <nav>
        <h2><a href="#" class="logo">Dear Diary</a></h2>
        <ul class="navbar">
            <li><a href="aboutView.php">About us</a></li>
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
        <div class="box">
            <?php if (isset($error)){ echo "<span id='login-error'>" . $error . "</span>"; } ?>
            <button data-close="modal" id="close1" class="close"> <p>X</p></button>
            <form method="POST" action="<?=BASE. "/index.php?action=login&type=regular"?>" class="signin">
                <span id="header-text">Sign Up</span>
                <div class="input-container">
                    <input id="login-ue" type="text" required name="login-ue" <?php if(isset($username)) {echo "value='" . $username . "'";}?> />
                    <label for="login-ue">Username</label>
                </div>
                <div class="input-container">
                    <input id="login-ue" type="text" required name="login-ue" <?php if(isset($username)) {echo "value='" . $username . "'";}?> />
                    <label for="login-ue">Email</label>
                </div>
                <div class="input-container">
                    <input id="login-p" type="password" required name="login-p"/>
                    <label for="login-p">Password</label>
                </div>
                <div class="input-container">
                    <input id="login-p" type="password" required name="login-p"/>
                    <label for="login-p">Confirm Password</label>
                </div>
                <button type="submit" id="login-btn">Sign Up</button>
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
        </div>
        <script src="https://accounts.google.com/gsi/client" async defer></script>
    </div>
    <div class="blur"></div>
    <div class="hero">
        <div class="content">
            <h2>
                Dear Diary. <br><span>Your journal for life</span>.
            </h2>
            <p>
                The <span>#1</span> app for <span>journaling</span>.
            </p>
        </div>
        <div class="comment-container">
            <div class="text-container">
                <p>
                    “It feels almost sacred: A completely private digital space.”
                </p>
                <div class="text-person">
                    <p>
                        Famous Youtuber
                    </p>
                </div>
            </div>
            <div class="text-container">
                <p>
                    “Dear Diary makes journaling as easy as composing a tweet.”
                </p>
                <div class="text-person">
                    <p>
                        Forbes
                    </p>
                </div>
            </div>
            <div class="text-container">
                <p>
                    "Dear Diary looks good, works great, and most importantly,<br> 
                    I own and control my data."
                </p>
                <div class="text-person">
                    <p>
                        CTO of Doist
                    </p>
                </div>
            </div>
            <div class="text-container">
                <p>
                    “Dear Diary is life changing.
                    It's not just a note taking app,<br>
                    it's a better way to think.”
                </p>
                <div class="text-person">
                    <p>
                        Famous Creator
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <section>
        <div class="feature-container">
            <h3>
            Meet Dear Diary, Your Self-Care Journal
            </h3>
            <div class="feature-content">
                <div class='feature-text-container'>
                    <div class="jr-text-container">
                        <p>
                            Join millions of Dear Diary users and create a healthier, 
                            happier mind. A sanctuary for your mind and soul, Dear Diary
                            will help increase your positive energy, be more grateful
                            and a calmer mind by building healthy thinkings through
                            journaling.
                        </p>
                        <br>
                        <p>
                        We're more than just a journal, or a diary; 
                        we're your own motivational coach and happiness
                        trainer. Let's embark on a fabulous journey
                        of self-improvement today.
                        </p>
                    </div>
                    <div class="jr-feature-container">
                        <div class="list-item">
                            <div class="list-item-avatar">
                                <img src="./public/images/playstore_icon.png" 
                                alt="playstore icon">
                            </div>
                            <div class="list-item-content">
                                <p>
                                    Google Editors' Choice 2019 - 2022
                                </p>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="list-item-avatar">
                                <img src="./public/images/apple_icon.png" 
                                    alt="apple icon">
                            </div>
                            <div class="list-item-content">
                                <p>
                                    iOS App Store - App of the Day 202
                                </p>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="list-item-avatar">
                                <img src="./public/images/trophy_icon.png" 
                                    alt="trophy icon">
                            </div> 
                            <div class="list-item-content">
                                <p>
                                    Best of 2021 Apps
                                </p>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="list-item-avatar">
                                <img src="./public/images/android_icon.png" 
                                    alt="android icon">
                            </div>
                            <div class="list-item-content">
                                <p>
                                    Excellence Award 2020
                                </p>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="list-item-avatar">
                                <img src="./public/images/ios_icon.png" 
                                    alt="ios icon">
                            </div> 
                            <div class="list-item-content">
                                <p>
                                    iOS App Store Best New Update
                                </p>
                            </div>
                        </div>
                        <div class="list-item">
                            <div class="list-item-avatar">
                                <img src="./public/images/feature_icon.png" 
                                    alt="feature icon">
                            </div>
                            <div class="list-item-content">
                                <p>
                                    Featured on Vogue, The New York 
                                </p>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>

        </div>
    </section>

    <section>
        <div class="note-container">
            <h1>
                Notes for your <br>
                grandchildren
            </h1>
            <h4>
                In our age when cloud services can shut down,
                get bought, or change privacy policy any day,
                the last thing you want is proprietary format
                and data lock-in.
            </h4>
            <h4>
                With Dear Diary, your data sits in a local folder.
                Never leave your life's work held hostage
                in the cloud again.
            </h4>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-row">
                <div class="col">
                    <a href="#">
                        <span>
                            <i class='bx bxl-facebook-circle' ></i>
                        </span>
                    </a>
                    <a href="#">
                        <span>
                            <i class='bx bxl-instagram' ></i>
                        </span>
                    </a>
                    <a href="#">
                        <span>
                            <i class='bx bxl-twitter' ></i>
                        </span>
                    </a>
                    <a href="#">
                        <span>
                            <i class='bx bxl-tiktok' ></i>
                        </span>
                    </a>
                    <a href="#">
                        <span>
                            <i class='bx bxl-snapchat' ></i>
                        </span>
                    </a>
                    <a href="#">
                        <span>
                            <i class='bx bxl-pinterest' ></i>
                        </span>
                    </a>
                </div>
            </div>
            <hr role="separator">
            <div class="footer-main">
                <ul class="footer-menu">
                    <li class="menu-item">
                        <a href="" class="menu-item-title">
                            GET THE APP
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="#">
                                    iPhone/iPad/Watch
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    MAC
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Android
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Browser Extensions
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-item-title">
                            OFFERS
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="#">
                                    Features
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Pricing
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Book Printing
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Send a gift
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Redeem a gift
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-item-title">
                            ABOUT
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="#">
                                    About Dear Diary
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Privacy and Security FAQs
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Press
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Podcast
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Community
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-item-title">
                            HELP
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="#">
                                    Help Guides
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Contact Us
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Career
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Terms
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Privacy
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="" class="menu-item-title">
                            SOCIAL
                        </a>
                        <ul class="sub-menu">
                            <li class="sub-menu-item">
                                <a href="#">
                                    Facebook
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Twitter
                                </a>
                            </li>
                            <li class="sub-menu-item">
                                <a href="#">
                                    Instagram
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-card">
            <span>
                © 2022 Dear Diary Corporation
            </span>
        </div>
    </footer>
</div>

<script>
// function login() {
    // }    
let blur = document.querySelector(".blur");

function openLogin() {
    document.getElementById("login").style.display = "block";
    blur.style.display = "block";
    blur.addEventListener('click', closeLogin);

}

function openSignup() {
    document.getElementById ("signup").style.display = "block";
    blur.style.display = "block";
    blur.addEventListener('click', closeSignup);

}

function closeLogin() {
    document.getElementById('login').style.display = 'none';
    document.querySelector(".blur").style.display = "none";
    blur.removeEventListener('click', closeLogin);

}

function closeSignup() {
    document.querySelector(".blur").style.display = "none";
    document.getElementById("signup").style.display = "none";
    blur.removeEventListener('click', closeSignup);

}

document.querySelector("#close").addEventListener('click', closeLogin)
document.querySelector("#close1").addEventListener('click', closeSignup)
document.querySelector(".btn").addEventListener('click', openLogin)
document.querySelector(".btn1").addEventListener('click', openSignup)

document.getElementById("sign-up-link").addEventListener('click', () => {
    closeLogin();
    openSignup();
})
</script>
<?php $content = ob_get_clean(); ?>
<?php require("templateView.php"); ?>










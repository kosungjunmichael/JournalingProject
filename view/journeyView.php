<?php $title = "Journey"; ?>
<?php $style = "journey" ?>
<?php $script = "script";?>


<?php ob_start(); ?>
<div class="container">
    <nav>
        <h2><a href="#" class="logo">Dear Diary</a></h2>
        <ul class="navbar">
            <li><a href="#">About us</a></li>
            <!-- <li><a href="#">Login</a></li> -->
            <li><a href="#" data-target="#login" data-toggle="modal" onclick="login();" class="btn" >Login</a></li>
            <li><a href="#">Signup</a></li>
        </ul>
    </nav>
    <div id="login" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <!-- <button data-close="modal" class="close" onclick="document.getElementById('login').style.display = 'none';">&times;</button> -->
                    <button data-close="modal" class="close"> <p>X</p></button>
                    <form>
                    <input type="text" name="username" class="username form-control" placeholder="Username"/>
                    <input type="password" name="password" class="password form-control" placeholder="Password"/>
                    <input class="btn login" type="submit" value="Login" />
                    </form>
                </div>
            </div>
        </div>  
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
                                <img src="./public/images/static/playstore_icon.png" 
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
                                <img src="./public/images/static/apple_icon.png" 
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
                                <img src="./public/images/static/trophy_icon.png" 
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
                                <img src="./public/images/static/android_icon.png" 
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
                                <img src="./public/images/static/ios_icon.png" 
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
                                <img src="./public/images/static/feature_icon.png" 
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
            <p>
                In our age when cloud services can <span>shut down,
                get bought,</span> or <span>change privacy policy</span> any day,
                the last thing you want is proprietary format
                and data lock-in.
            </p>
            <p>
                With Dear Diary, <b>your data sits in a local folder</b>.
                Never leave your life's work held hostage
                in the cloud again.
            </p>
            <p>
                Our community welcomes anyone who uses Dear Diary or is interested
                 in Dear Diary, no matter your language, country, or field. Come join us!
            </p>
            <div class="subfeature-boxes"> 
                <div class="subfeature">
                    <div class="subfeature-title">
                        <i class='bx bxs-book-open'></i>
                        <span>
                            Learn together
                        </span>
                    </div>
                    <div class="subfeature-description">
                        <p>
                            " Our community is extremely friendly and helpful to new members.
                            Got a question? Ask away! "
                        </p>
                        <p>
                            " We also share our notes, and our learning journey with each other. "
                        </p>
                    </div>
                </div>
                <div class="subfeature">
                    <div class="subfeature-title">
                        <i class='bx bxs-edit' ></i>
                        <span>
                            Create together
                        </span>
                    </div>
                    <div class="subfeature-description">
                        <p>
                            " Most of the community plugin and theme developers also hang out
                             in our community. Learn together and make something awesome!
                              Teamwork makes the dream work. "
                        </p>
                    </div>
                </div>
                <div class="subfeature">
                    <div class="subfeature-title">
                        <i class='bx bxs-bus-school' ></i>
                        <span>
                            Always available
                        </span>
                    </div>
                    <div class="subfeature-description">
                        <p>
                            " No internet? No problem. Obsidian works completely offline, 
                            internet or service issues will never be your problem. "
                        </p>
                        <p>
                            " Enjoy reading and working on your notes anytime, anywhere. "
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="twitter-container">
            <h2>
                People ❤️ Dear Diary.
            </h2>
            <p>
                Over 100,000&nbsp;
                <a href="#">
                    5-star reviews
                </a>.
            </p>
            <div class="tweets-container">
                <div class="tweet-column">
                    <div class="twitter-block">
                        <div class="author-box">
                            <div class="twitter-profile">
                                <a href="#" class="author-avatar">
                                    <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="user_image" class="user_image">
                                </a>
                                <a href="#" class="author-name">
                                    Alex Isak
                                </a>
                                <a href="#" class="author-screenname">
                                    @marvelnian
                                </a>
                            </div>
                            <div class="twitter-logo">
                                <i class='bx bxl-twitter'></i>
                            </div>
                        </div>
                        <div class="twitter-content">
                            <p class="tweet-content">
                                <a href="#">
                                    @deardiaryapp
                                </a>
                                2 years to the day since downloading Dear<br> Diary. 730 entries & no days missed!
                            </p>
                        </div>
                    </div>
                    <div class="twitter-block">
                        <div class="author-box">
                            <div class="twitter-profile">
                                <a href="#" class="author-avatar">
                                    <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="user_image" class="user_image">
                                </a>
                                <a href="#" class="author-name">
                                    Saint-Maximin
                                </a>
                                <a href="#" class="author-screenname">
                                    @Maxcastle1999
                                </a>
                            </div>
                            <div class="twitter-logo">
                                <i class='bx bxl-twitter'></i>
                            </div>
                        </div>
                        <div class="twitter-content">
                            <p class="tweet-content">
                                <a href="#">
                                    @deardiaryapp
                                </a>
                                New to Journaling! Would love some ideas for<br> what topics and templates
                                 you all have created, what tags do<br> you all find useful? Just looking
                                  for ideas to build my journal!<br> Thanks
                            </p>
                        </div>
                    </div>
                </div>
                <div class="tweet-column">
                    <div class="twitter-block">
                        <div class="author-box">
                            <div href="#" class="twitter-profile">
                                <a class="author-avatar">
                                    <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="user_image" class="user_image">
                                </a>
                                <a href="#" class="author-name">
                                    Kieran Guimarães
                                </a>
                                <a href="#" class="author-screenname">
                                    @kieranguimaraes
                                </a>
                            </div>
                            <div class="twitter-logo">
                                <i class='bx bxl-twitter'></i>
                            </div>
                        </div>
                        <div class="twitter-content">
                            <p class="tweet-content">
                                With 20 minutes left in the day, I kept my <a href="#">@deardiaryapp</a><br>
                                writing streak alive. 1,422 days and counting.
                            </p>
                        </div>
                    </div>
                    <div class="twitter-block">
                        <div class="author-box">
                            <div class="twitter-profile">
                                <a href="#" class="author-avatar">
                                    <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="user_image" class="user_image">
                                </a>
                                <a href="#" class="author-name">
                                    Nick Almirón
                                </a>
                                <a href="#" class="author-screenname">
                                    @newmiron2022
                                </a>
                            </div>
                            <div class="twitter-logo">
                                <i class='bx bxl-twitter'></i>
                            </div>
                        </div>
                        <div class="twitter-content">
                            <p class="tweet-content">
                                Damn <a href="#">@deardiaryapp</a> that text feature is amazing!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
document.querySelector(".close").addEventListener('click', () => {
    document.getElementById('login').style.display = 'none';
    document.querySelector(".blur").style.display = "none";
})

document.querySelector(".btn").addEventListener('click', () =>{
    document.getElementById("login").style.display = "block";
    document.querySelector(".blur").style.display = "block";
})
</script>
<?php $content = ob_get_clean(); ?>
<?php require("templateView.php"); ?>










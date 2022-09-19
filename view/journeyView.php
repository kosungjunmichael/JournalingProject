<?php $title = "Journey"; ?>
<?php $style = "journey" ?>

<?php ob_start(); ?>
<div class="container">
    <nav>
        <h2><a href="#" class="logo">Dear Diary</a></h2>
        <ul class="navbar">
            <li><a href="#">About us</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#">Signup</a></li>
        </ul>
    </nav>
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
            <div class='feature-text-container'>
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

        </div>
    </section>
    <footer>
        
    </footer>
</div>
<?php $content = ob_get_clean(); ?>
<?php require("templateView.php"); ?>

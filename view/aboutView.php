<?php $title = "About Us" ;?>

<?php $style = "aboutView";?>

<?php ob_start(); ?>
<?php include(ROOT . "/view/header.php"); ?>

<div class="landing-box">
    <div class="about">
        <h1>
            About
        </h1>
        <br>
        <p>
            Dear Diary is a journaling app for the iPhone, iPad and Mac. From once-in-a-lifetime events 
            to everyday moments, Dear Diary’s elegant interface makes journaling your life a simple 
            pleasure. <br>
            <br>
            Dear Diary launched on the iOS and Mac App Stores in 2022 to fill a need: record and store 
            the important memories, photos, and details of life. The response to Dear Diary has been 
            overwhelming: Over ten million downloads, Editor’s Choice, App of the Year, Apple Design 
            Award, and, most of all, a solid 4.8-star rating from our fantastic users.
        </p>
    </div>
    <br>
    <div class="team">
        <h1>Our Team</h1>
        <br>
        <p>
            The Dear Diary Team is a talented group of engineers and specialists, working remotely from 
            across the world. <br>
            <br>
            Feel free to <a href="#">contact</a> us.
        </p>

        <div id="about-us-container">
            <div id="about-us-row">
                <div class="about-us-card">
                    <div class="member-img-container">
                        <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="member_img" class="member_img">
                    </div>                    
                    <div class="about-us-description">
                        <h2 class="member-name">James</h2>
                        <p class="member-title">CTO</p>
                        <p class="member-describe">Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p class="member-email">james@example.com</p>
                        <p><button class="member-button">Contact</button></p>
                    </div>
                </div>
                <div class="about-us-card">
                    <div class="member-img-container">
                        <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="member_img" class="member_img">
                    </div>                    
                    <div class="about-us-description">
                        <h2 class="member-name">Insu</h2>
                        <p class="member-title">Software Engineer</p>
                        <p class="member-describe">Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p class="member-email">insu@example.com</p>
                        <p><button class="member-button">Contact</button></p>
                    </div>
                </div>
                <div class="about-us-card">
                    <div class="member-img-container">
                        <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="member_img" class="member_img">
                    </div>
                    <div class="about-us-description">
                        <h2 class="member-name">Sude</h2>
                        <p class="member-title">Software Engineer</p>
                        <p class="member-describe">Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p class="member-email">sude@example.com</p>
                        <p><button class="member-button">Contact</button></p>
                    </div>
                </div>
                <div class="about-us-card">
                    <div class="member-img-container">
                        <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="member_img" class="member_img">
                    </div>                    
                    <div class="about-us-description">
                        <h2 class="member-name">Vorleak</h2>
                        <p class="member-title">Software Engineer</p>
                        <p class="member-describe">Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p class="member-email">vorleak@example.com</p>
                        <p><button class="member-button">Contact</button></p>
                    </div>
                </div>
            </div>
            <div id="about-us-row">
                <div class="about-us-card">
                    <div class="member-img-container">
                        <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="member_img" class="member_img">
                    </div>                    
                    <div class="about-us-description">
                        <h2 class="member-name">Michael</h2>
                        <p class="member-title">Software Engineer</p>
                        <p class="member-describe">Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p class="member-email">michael@example.com</p>
                        <p><button class="member-button">Contact</button></p>
                    </div>
                </div>
                <div class="about-us-card">
                    <div class="member-img-container">
                        <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="member_img" class="member_img">
                    </div>                    
                    <div class="about-us-description">
                        <h2 class="member-name">Sungjun</h2>
                        <p class="member-title">Software Engineer</p>
                        <p class="member-describe">Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p class="member-email">sungjun@example.com</p>
                        <p><button class="member-button">Contact</button></p>
                    </div>
                </div>
                <div class="about-us-card">
                    <div class="member-img-container">
                        <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="member_img" class="member_img">
                    </div>                    
                    <div class="about-us-description">
                        <h2 class="member-name">Sam</h2>
                        <p class="member-title">Software Engineer</p>
                        <p class="member-describe">Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p class="member-email">sam@example.com</p>
                        <p><button class="member-button">Contact</button></p>
                    </div>
                </div>
                <div class="about-us-card">
                    <div class="member-img-container">
                        <img src="https://i.pravatar.cc/40?img=<?= rand(1,70) ?>" alt="member_img" class="member_img">
                    </div>                    
                    <div class="about-us-description">
                        <h2 class="member-name">Alex</h2>
                        <p class="member-title">Software Engineer</p>
                        <p class="member-describe">Some text that describes me lorem ipsum ipsum lorem.</p>
                        <p class="member-email">alex@example.com</p>
                        <p><button class="member-button">Contact</button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="products">
        <h1>Dear Diary Products</h1>
        <br>
        <h4>PC</h4>
        <p>
            This award-winning app is packed with powerful features, including a map view, quick entry 
            menu bar, and timeline filters. Learn more.
        </p>
        <br>
        <h4>Phone and Ipad</h4>
        <p>
            Journal on-the-go using your iOS devices. Never lose the context of “when, where, and what”
            with automatic date, time, location, weather, and motion activity metadata.
        </p>
    </div>

</div>

<?php include(ROOT . "/view/footer.php"); ?>

<?php $content = ob_get_clean(); ?>
<?php 
// require("journeyTemplate.php"); 
?>
<?php 
require("template.php"); 
?>
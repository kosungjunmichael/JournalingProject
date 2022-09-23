<?php $title = "AboutUs" ;?>
<?php $style = "aboutView";?>

<?php ob_start(); ?>
<?php include "headerView.php"; ?>



<div id="basicInfo">
    <div class="about">
        <h1>About</h1>
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
        <h1>Team</h1>
        <br>
        <p>
            The Dear Diary Team is a talented group of engineers and specialists, working remotely from 
            across the world. <br>
            <br>
            Feel free to <a href="#">contact</a> us.</p>
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

<?php $content = ob_get_clean(); ?>
<?php require("journeyTemplate.php"); ?>
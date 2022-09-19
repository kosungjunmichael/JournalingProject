
<div id="sidebar-container">
    <div id="sidebar-top">
        <div id="logo-container">
            <img id="logo-img" src="<?=BASE."/public/images/DearDiaryLogoDark.png"?>" alt="logo">
            <div id="logo-title">
                Dear Diary
            </div>
        </div>
        <ul id="sidebar-navlinks">
            <li>
                <a class="sidebar-link" href="./index.php?action=linkTo&page=toTimeline">
                    <i class='bx bx-time' ></i>
                    <span>Timeline</span>
                </a>
            </li>
            <li>
                <a class="sidebar-link" href="#">
                    <i class='bx bx-photo-album' ></i>
                    <span>Album</span>
                </a>
            </li>
            <li>
                <a class="sidebar-link" href="#">
                    <i class='bx bx-calendar' ></i>
                    <span>Calendar</span>
                </a>
            </li>
            <li>
                <a class="sidebar-link" href="#">
                    <i class='bx bx-map' ></i>
                    <span>Map</span>
                </a>
            </li>
        </ul>
        <a id="create-entry-btn" href="<?=BASE."/index.php?action=linkTo&page=createEntry"?>">Create Entry</a>
    </div>
    <div id="sidebar-bottom">
        <div id="theme-toggle">
            <i class='bx bx-sun'></i>
            <div id="theme-toggle-pill">
                <span id="theme-toggle-inner"></span>
            </div>
            <i class='bx bx-moon' ></i>
        </div>
    </div>
</div>
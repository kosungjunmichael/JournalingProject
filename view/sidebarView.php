
<div id="sidebar-container">
    <div id="sidebar-top">
        <a href="<?=BASE."/index.php?action=toLanding"?>">
            <div id="logo-container">
                <svg id="logo-img" width="33" height="40" viewBox="0 0 33 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="logo-svg-box" d="M7 7H32V37C32 38.1046 31.1046 39 30 39H7V7Z" fill="#fff"/>
                    <path d="M7 7H32V37C32 38.1046 31.1046 39 30 39H7V7Z" stroke="#9673F5" stroke-width="2"/>
                    <rect class="logo-svg-box" x="4" y="4" width="25" height="32" fill="#fff"/>
                    <rect x="4" y="4" width="25" height="32" stroke="#9673F5" stroke-width="2"/>
                    <rect class="logo-svg-box" x="1" y="1" width="25" height="32" fill="#fff"/>
                    <rect x="1" y="1" width="25" height="32" stroke="#9673F5" stroke-width="2"/>
                    <line x1="0.707107" y1="33.2929" x2="6.70711" y2="39.2929" stroke="#9673F5" stroke-width="2"/>
                    <line x1="0.707107" y1="32.2929" x2="6.70711" y2="38.2929" stroke="#9673F5" stroke-width="2"/>
                </svg>
                <div id="logo-title">
                    Dear Diary
                </div>
            </div>
        </a>
        <ul id="sidebar-navlinks">
            <li>
                <a class="sidebar-link" href="./index.php?action=linkTo&page=toTimeline">
                    <i class='bx bx-time' ></i>
                    <span>Timeline</span>
                </a>
            </li>
            <li>
                <a class="sidebar-link" href="./index.php?action=linkTo&page=toAlbum">
                    <i class='bx bx-photo-album' ></i>
                    <span>Album</span>
                </a>
            </li>
            <li>
                <a class="sidebar-link" href="./index.php?action=linkTo&page=toCalendar">
                    <i class='bx bx-calendar' ></i>
                    <span>Calendar</span>
                </a>
            </li>
            <li>
                <a class="sidebar-link" href="./index.php?action=linkTo&page=toMap">
                    <i class='bx bx-map' ></i>
                    <span>Map</span>
                </a>
            </li>
        </ul>
        <a id="create-entry-btn" href="<?=BASE."/index.php?action=createEntry"?>">Create Entry</a>
    </div>
    <div id="sidebar-bottom">
        <div id="theme-toggle">
            <i class='bx bx-sun'></i>
            <input id="theme-toggle-input" type="checkbox">
            <div id="theme-toggle-pill">
                <span id="theme-toggle-inner"></span>
            </div>
            <i class='bx bx-moon' ></i>
        </div>
    </div>
</div>

<div id="sidebar-container">
    <div id="nav-top">
        <div id="logo-container">
            <div id="logo">
                <img src="<?=BASE."/public/images/logo.png"?>" alt="logo" width="200px" class="logo_img">
                <div class="logo_name">
                    Dear Diary
                </div>
            </div>
        </div>
        <div id="nav-mid">
            <ul id="nav_list">
                <li>
                    <a href="#">
                        <i class='bx bx-time' ></i>
                        <span class="timeline">Timeline</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-photo-album' ></i>
                        <span class="album">Album</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-calendar' ></i>
                        <span class="calendar">Calendar</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-map' ></i>
                        <span class="map">Map</span>
                    </a>
                </li>
            </ul>
            <div>
                <a class="create_entry_btn" href="<?=BASE."/index.php?action=linkTo&page=createEntry"?>">Create Entry</a>
            </div>
        </div>
    </div>
    <div class="nav_footer">
        <div class="toggle">
            <i class='bx bx-sun' ></i>
            <input type="checkbox" id="darkmode-toggle">
            <label for="darkmode-toggle"></label>
            <i class='bx bx-moon' ></i>
        </div>
        <div class="setting">
            <a href="#">
                <i class='bx bx-cog'></i>
                <span>Settings</span>
            </a>
        </div>
    </div>
</div>
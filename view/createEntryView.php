<?php

if (!isset($_SESSION["uid"])) {
    throw new Exception("401 - Unauthorized");
} ?>
<?php $title = "Create New Entry"; ?>
<?php $style = "createEntry"; ?>
<?php $script = "createEntry"; ?>

<?php ob_start(); ?>

<?php include "sidebarView.php"; ?>

<div id="create-entry-container">
    <form id="create-entry-form" action="<?= BASE . "/index.php?action=addNewEntry" ?>" method="post" enctype="multipart/form-data">
        <h2 id="create-entry-header-text">CREATE A NEW ENTRY</h2>

        <!-- TITLE -->
        <div id="create-entry-title">
            <input id="create-entry-title-input" type="text" name="title" placeholder="Entry Title" />
        </div>

        <!-- TAG -->
        <div id="create-entry-tag-container">
            <div id="create-entry-tag">
<!--                <div id="create-tag-btn">-->
<!--                    <i class="fa-solid fa-plus"></i>-->
<!--                </div>-->
    <!--            <input type="text" id="create-tag-input" placeholder="Add a Tag">-->
                <i class="ph-tag"></i>
                <ul id="create-entry-tag-input-ul">
                    <input type="text" name="entryTag" id="create-entry-tag-input" placeholder="Type Tag & Press Enter"/>
                    <input type="text" name="tagNames" id="create-entry-tags-hidden" hidden/>
                </ul>
            </div>
            <div id="create-entry-tag-details">
                <p id="create-entry-tag-details-p"><span id="create-entry-tag-details-tagnum"></span> tags are remaining</p>
                <button id="tag-remove-btn" type="button">Remove All</button>
            </div>
        </div>
       <!-- <div id="tag-cont">-->
<!--            <input type="text" name="tagNames" class="submitted-tags-input" hidden>-->
<!--        </div> -->

        <!-- LOCATION -->
        <div id="create-entry-location">
            <i class='bx bx-current-location'></i>
            <input id="create-entry-location-input" type="text" name="location" placeholder="Location" />
        </div>

        <!-- WEATHER -->
        <div id="create-entry-weather">
            <select id="weather-select" name="weather">
                <option value="">Select Weather</option>
                <option value="0">Sunny</option>
                <option value="1">Rainy</option>
                <option value="2">Cloudy</option>
                <option value="3">Snowy</option>
            </select>
        </div>

        <!-- TEXT Editor -->
        <div id="create-entry-text-content" class="txt-container">
            <div class="options">
            <!-- Text Format -->
            <button id="bold" type="button" class="option-button format">
            <i class="fa-solid fa-bold"></i>
            </button>
            <button id="italic" type="button" class="option-button format">
            <i class="fa-solid fa-italic"></i>
            </button>
            <button id="underline" type="button" class="option-button format">
            <i class="fa-solid fa-underline"></i>
            </button>

            <!-- List -->
            <button id="insertOrderedList" type="button" class="option-button">
            <div class="fa-solid fa-list-ol"></div>
            </button>
            <button id="insertUnorderedList" type="button" class="option-button">
            <i class="fa-solid fa-list"></i>
            </button>

            <!-- Alignment -->
            <button id="justifyLeft" type="button" class="option-button align">
            <i class="fa-solid fa-align-left"></i>
            </button>
            <button id="justifyCenter" type="button" class="option-button align">
            <i class="fa-solid fa-align-center"></i>
            </button>
            <button id="justifyRight" type="button" class="option-button align">
            <i class="fa-solid fa-align-right"></i>
            </button>
            <button id="justifyFull" type="button" class="option-button align">
            <i class="fa-solid fa-align-justify"></i>
            </button>
            <button id="indent" type="button" class="option-button spacing">
            <i class="fa-solid fa-indent"></i>
            </button>
            <button id="outdent" type="button" class="option-button spacing">
            <i class="fa-solid fa-outdent"></i>
            </button>

            <!-- Font -->
            <select id="fontName" class="adv-option-button"></select>
            <select id="fontSize" class="adv-option-button"></select>

            <!-- Color -->
            <div class="input-wrapper">
            <input type="color" id="foreColor" class="adv-option-button" />
            <label for="foreColor">Color</label>
            </div>
            <div class="input-wrapper">
            <input type="color" id="backColor" class="adv-option-button" />
            <label for="backColor">Highlight</label>
            </div>
            </div>
        <!--//WARNING: THE ACTION PAGE SHOULD BE CHANGE -->
            <div id="input-text" contenteditable="true"></div>
            <textarea type="text" id="text-content-textarea" name="textContent" hidden></textarea>
        </div>

        <div id="entry-upload-photo">
        </div>

        <!-- IMAGE UPLOAD -->
        <div id="create-entry-bottom">
            <input type="file" name="imgUpload" id="imgUpload" accept="image/png, image/jpeg, image/jpg" style="display:none;" />
            <div class="entry-photo" onclick="document.getElementById('imgUpload').click();">
                <label>
                    <i id='upload-icon' class='bx bx-cloud-upload bx-md'></i>
                    Add photo
                </label>
            </div>
            <div id="create-entry-submit">
                <input type="submit" id="submit" value="Submit"/>
            </div>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>
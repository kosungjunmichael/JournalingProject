<?php $title = "Entry Title";?>
<?php $style = "viewEntry";?>
<?php //echo "<pre>"?>
<?php //print_r($entryContent)?>
<?php //echo "</pre>"?>
<?php ob_start();?>
<?php include("sidebarView.php");?>
<article id="view-entry-container">
    <div id="view-entry-top">
        <div id="view-entry-details">
            <h1 id="entry-title">
                <?= $entryContent['title']; ?>
            </h1>
            <div id="details-row">
                <div id="entry-tags">
                    <div class="tag">weekend</div>
                    <div class="tag">summer</div>
                </div>
                <div id="entry-created">
                    <i class="ph-calendar-blank"></i>
                    <?= date_format(date_create($entryContent['date_created']), 'F d, Y'); ?>
                </div>
                <div id="entry-location">
                    <i class="ph-map-pin"></i>
                    <?= $entryContent['location']; ?>
                </div>
                <div id="entry-weather">
                    <i class="ph-sun-dim"></i>
                    <?php
                        switch($entryContent['weather']){
                            case 0:
                                echo "Sunny";
                                break;
                            case 1:
                                echo "Rainy";
                                break;
                            case 2:
                                echo "Cloudy";
                                break;
                            case 3:
                                echo "Snowy";
                                break;
                            default:
                                echo "N/A";
                                break;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div id="view-entry-edit">
            <a href="createEntryView.php?action=edit&id=12345" id="edit-btn">
                <i class="ph-pen"></i>
                Edit Entry
            </a>
            <span id="view-entry-edited">
                Last Edited: <?= date_format(date_create($entryContent['last_edited']), 'Y/m/d') . ' at ' . date_format(date_create($entryContent['last_edited']), 'g:i:s A'); ?>
            </span>
        </div>
    </div>
    <div id="view-entry-photos">
        <div class="img-container">
            <img src="https://images.unsplash.com/photo-1568515387631-8b650bbcdb90?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y2VudHJhbCUyMHBhcmt8ZW58MHx8MHx8&auto=format&fit=crop&w=800&q=60"/>
        </div>
        <div class="img-container">
            <img src="https://images.unsplash.com/photo-1568515387631-8b650bbcdb90?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MXx8Y2VudHJhbCUyMHBhcmt8ZW58MHx8MHx8&auto=format&fit=crop&w=800&q=60"/>
        </div>
        <div class="img-container">
            <img src="https://images.unsplash.com/photo-1575372587186-5012f8886b4e?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8Y2VudHJhbCUyMHBhcmt8ZW58MHx8MHx8&auto=format&fit=crop&w=800&q=60"/>
        </div>
        <div class="img-container">
            <img src="https://images.unsplash.com/photo-1623593419606-7f9c8c22d736?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8Y2VudHJhbCUyMHBhcmt8ZW58MHx8MHx8&auto=format&fit=crop&w=800&q=60"/>
        </div>
    </div>
    <div id="view-entry-text-content">
        <?= $entryContent['text_content'] ?>
    </div>
</article>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>
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
                    <?php
                        $tagManager = new TagManager();
                        $entryTags = $tagManager->getTags($entryContent['u_id']);
                        if (!empty($entryTags)){
                            foreach($entryTags as $tag){
                    ?>
                                <div class="tag"><?= htmlspecialchars($tag['tag_name']);?></div>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="no-tag">no tags</div>
                        <?php
                        }
                        ?>
                    <!-- <div class="tag">weekend</div>
                    <div class="tag">summer</div> -->
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
        <?php 
            foreach($entryContent['images'] as $image){
                $img_source = $image['path'];
                include "entryImageCard.php";
            }
        ?>
    </div>
    <div id="view-entry-text-content">
        <?= $entryContent['text_content'] ?>
    </div>
</article>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>
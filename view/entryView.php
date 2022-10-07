<?php $title = "Entry Title"; ?>
<?php $style = "viewEntry"; ?>
<?php $script = "viewEntry"; ?>

<?php
//echo "<pre>"
?>
<?php
//print_r($entryContent)
?>
<?php
//echo "</pre>"
?>
<?php ob_start(); ?>
<?php include "sidebarView.php"; ?>
<article id="view-entry-container">
    <div id="view-entry-top">
        <div id="view-entry-details">
            <h1 id="entry-title">
                <?= htmlspecialchars($entryContent["title"]) ?>
            </h1>
            <div id="details-row">
                <div id="entry-tags">
                    <?php
                    $entryTags = explode(",", $entryContent["tags"]);
                    foreach ($entryTags as $tag) {
                        if (!empty($tag)) { ?>
                            <div class="tag"><?= htmlspecialchars($tag) ?></div>
                        <?php } else { ?>
                            <div class="no-tag">no tags</div>
                    <?php }
                    }
                    ?>
                </div>
                <div id="entry-created">
                    <i class="ph-calendar-blank"></i>
                    <?= date_format(
                        date_create($entryContent["date_created"]),
                        "F d, Y"
                    ) ?>
                </div>
                <div id="entry-location">
                    <i class="ph-map-pin"></i>
                    <?= htmlspecialchars($entryContent["location"]) ?>
                </div>
                <div id="entry-weather">
                    <?php switch ($entryContent["weather"]) {
                        case 0: ?>
                            <i class="fa-sharp fa-solid fa-sun"></i>
                            Sunny
                        <?php break;
                        case 1: ?>
                            <i class="fa-solid fa-cloud-rain"></i>
                            Rainy
                        <?php break;
                        case 2: ?>
                            <i class="fa-solid fa-cloud"></i>
                            Cloudy
                        <?php break;
                        case 3: ?>
                            <i class="fa-regular fa-snowflake"></i>
                            Snowy
                        <?php break;
                        default: ?>
                            <i class="fa-solid fa-ban"></i>
                            N/A
                    <?php break;
                    } ?>
                </div>
            </div>
        </div>
        <div id="view-entry-edit">
            <div id="edit-control-btns">
                <div class="entryID"><?=$entryContent['u_id']?></div>
                <a href="#" id="delete-btn">
                    <i class="ph-trash"></i>
                    Delete Entry
                </a>
                <a href="index.php?action=toEditEntry&id=<?=$entryContent['u_id']?>" id="edit-btn">
                    <i class="ph-pen"></i>
                    Edit Entry
                </a>
            </div>
            <span id="view-entry-edited">
                Last Edited: <?= date_format(
                                    date_create($entryContent["last_edited"]),
                                    "Y/m/d"
                                ) .
                                    " at " .
                                    date_format(
                                        date_create($entryContent["last_edited"]),
                                        "g:i:s A"
                                    ) ?>
            </span>
        </div>
    </div>
    <div id="view-entry-photos">
        <?php foreach ($entryContent["images"] as $image) {
            $img_source = $image["path"];
            include "entryImageCard.php";
        } ?>
    </div>
    <div id="view-entry-text-content">
        <?= strip_tags($entryContent["text_content"], "<p><blockquote><q><strong><em><ul><ol><li><font><style><b><i><u><div><span>") ?> 
    </div>
</article>

<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>
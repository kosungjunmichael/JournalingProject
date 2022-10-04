<a href="<?= BASE . "/index.php?action=viewEntry&id=". htmlspecialchars($entry['u_id'])?>">
    <div class="entry-container">
        <h4 class="entry-title" ><?= htmlspecialchars($entry['title']) ?></h4>
       <p class="entry-content"><?= strip_tags($entry['text_content'], "<br>") ?></p>
        <div class="entry-info">
            <div class="entry-tags">
                <?php
                    $entryTags = explode(",",$entry['tags']);
                    for ($i=0;$i<count($entryTags);$i++){
                        if (!empty($entryTags["$i"])){
                            if ($i < 3){
                ?>
                                <p class="tag"><?= htmlspecialchars($entryTags["$i"]);?></p>
                        <?php
                            } 
                        } else {
                        ?>
                            <p class="no-tag">no tags</p>
                    <?php
                        }
                    }
                    ?>
            </div>
            <p class="entry-date"> 
                <?= date_format(date_create($entry['last_edited']), 'F d, Y')?> 
            </p>
        </div>
    </div>
</a>



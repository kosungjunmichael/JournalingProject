<a href="<?= BASE . "/index.php?action=viewEntry&id=". htmlspecialchars($entry['u_id'])?>">
    <div class="entry-container">
        <div class="entry-title" ><?= htmlspecialchars($entry['title']) ?></div>
        <div class="entry-content"><?= htmlspecialchars($entry['text_content']) ?></div>
        <div class="entry-info">
            <div class="entry-tags">
                <?php
                    $entryTags = explode(",",$entry['tags']);
                    for ($i=0;$i<count($entryTags);$i++){
                        if (!empty($entryTags["$i"])){
                            if ($i < 3){
                ?>
                                <div class="tag"><?= htmlspecialchars($entryTags["$i"]);?></div>
                        <?php
                            } 
                        } else {
                        ?>
                            <div class="no-tag">no tags</div>
                    <?php
                        }
                    }
                    ?>
            </div>
            <div class="entry-date"> 
                <?= date_format(date_create($entry['last_edited']), 'F d, Y')?> 
            </div>
        </div>
    </div>
</a>



<a href="<?= BASE . "/index.php?action=viewEntry&id=". htmlspecialchars($entry['u_id'])?>">
    <div class="entry-container">
        <div class="entry-title" ><?= htmlspecialchars($entry['title']) ?></div>
        <div class="entry-content"><?= htmlspecialchars($entry['text_content']) ?></div>
        <div class="entry-info">
            <div class="entry-tags">
                <?php
                    $tagManager = new TagManager();
                    $entryTags = $tagManager->getTags($entry['u_id']);
                    if (!empty($entryTags)){
                        for ($i=0;$i<count($entryTags);$i++){
                        // foreach($entryTags as $tag){
                            if ($i < 3){
                ?>
                                <div class="tag"><?= htmlspecialchars($entryTags["$i"]['tag_name']);?></div>
                    <?php
                            }
                        }
                    } else {
                    ?>
                        <div class="no-tag">no tags</div>
                    <?php
                    }
                    ?>
            </div>
            <div class="entry-date"> 
                <?= htmlspecialchars($entry['month']), " ",htmlspecialchars($entry['day']), ", ", htmlspecialchars($entry['year'])?> 
            </div>
        </div>
    </div>
</a>



    <a href="<?= BASE . "/index.php?action=viewEntry&id=". htmlspecialchars($entry['u_id'])?>">
        <div class="entryContainer">
            <div class="entryTitle" ><?= htmlspecialchars($entry['title']) ?></div>
            <div class="entryContent"><?= htmlspecialchars($entry['text_content']) ?></div>
            <div class="entryInfo">
                <div class="entryTags">
                    <?php
                        $tagManager = new TagManager();
                        $entryTags = $tagManager->getTags($entry['u_id']);
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
                </div>
                <div class="entryDate"> <?= htmlspecialchars($entry['month']), " ",htmlspecialchars($entry['day']), ", ", htmlspecialchars($entry['year'])?> </div>
            </div>
        </div>
    </a>



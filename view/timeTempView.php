    <a href="<?= BASE . "/index.php?action=entries&type=view&id=". htmlspecialchars($entry['u_id'])?>">
        <div class="entryContainer">
            <h3><?= htmlspecialchars($entry['title']) ?></h3>
            <p><?= htmlspecialchars($entry['text_content']) ?></p>
            <h5>hashtags</h5>
            <h5> <?= htmlspecialchars($entry['month']), " ",htmlspecialchars($entry['day']), ", ", htmlspecialchars($entry['year'])?> </h5>
        </div>
    </a>



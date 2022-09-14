<?php $title = "Timeline";?>
<?php ob_start();?>

    <h1>Timeline</h1>
    <?php
        if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'registered') {
            echo "<p>You have been registered. Welcome!</p>";
        } else {
//            print_r($_SESSION);
        }
    ?>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
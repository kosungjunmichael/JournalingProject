<?php $title = "Timeline";?>
<?php ob_start();?>

<h1>Timeline</h1>
<?php
    if (isset($_REQUEST['type']) && $_REQUEST['type'] === 'registered') {
        // this should be turn into a little notification modal thing
        echo "<p>You have been registered. Welcome!</p>";
    }

//        session_start();
//        print_r($_SESSION);
?>

<?php $content = ob_get_clean(); ?>
<?php require('templateView.php'); ?>
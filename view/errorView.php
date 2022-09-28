<?php $title = "error"; ?>
<?php $script = "script"; ?>

<?php ob_start(); ?>
<div>
  <h2>ERROR:</h2>
  <h3><?= $errorMessage ?></h3>
  <img src="<?= BASE .
  	"/public/images/static/sadcat.png" ?>" alt="sadcat" width='300px' height='auto'>
</div>
<?php $content = ob_get_clean(); ?>
<?php require "template.php"; ?>

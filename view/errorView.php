<?php $title = "error" ;?>
<?php ob_start(); ?>
<div>
  <h2>ERROR:</h2>
  <h3><?= $errorMessage; ?></h3>
  <img src="../public/images/sadcat.png" alt="sadcat" width='300px' height='auto'>
</div>
<? $content = ob_get_clean(); ?>
<?php require("template.php"); ?>
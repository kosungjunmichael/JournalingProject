<?php $title = "Log In";?>
<?php ob_start();?>
    <div class="background">
        <div class="shape"></div>
        <div class="shape2"></div>
        <div class="shape3"></div>
        <div class="shape4"></div>
    </div>  
    <form method="POST" action="signin.php" class="signin">
        <h3>Login</h3>
        <input name="username" type="text" placeholder="Username" id="username" required>
        <input name="password" type="password" placeholder="Password" id="password" required>
        <button>Log In</button>
        <a href="index2.php" class="button2">Sign Up</a>
    </form>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
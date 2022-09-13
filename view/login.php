<?php $title = "Log In";?>
<?php $style = "login" ?>
<?php ob_start();?>
<!-- dark mode -->
    <div type="checkbox" id="darkMode" class="darkMode">Toggle</div>
    <label for="darkMode">
<!-- login -->
    <div class="box">
        <form method="POST" action="signin.php" class="signin">
            <span class="text-center">Login</span>
        <div class="input-container">
            <input type="text" required=""/>
            <label>Username</label>		
        </div>
        <div class="input-container">		
            <input type="mail" required=""/>
            <label>Password</label>
        </div>
            <button type="button" class="btn">Log In</button>
<!-- signup button -->
            <a href="signup.php" class="btn">Sign Up</a>
        </form>	
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
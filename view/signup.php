<?php $title = "SignUp";?>
<?php $style = "signup" ?>
<?php ob_start();?>
    <div class="box">
        <form method="POST" action="signup.php" class="signup">
            <span class="text-center">Sign Up</span>
        <div class="input-container">
            <input type="text" required=""/>
            <label>Username</label>		
        </div>
        <div class="input-container">
            <input type="text" required=""/>
            <label>Email</label>		
        </div>
        <div class="input-container">		
            <input type="mail" required=""/>
            <label>Password</label>
        </div>
        <div class="input-container">		
            <input type="mail" required=""/>
            <label>Confirm Password</label>
        </div>
            <button type="button" class="btn">Log In</button>
    <!-- signup button -->
            <a href="login.php" class="btn">Sign Up</a>
        </form>	
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>


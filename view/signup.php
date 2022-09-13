<?php $title = "SignUp";?>
<?php $style = "signup" ?>
<?php ob_start();?>
    <div class="box">
        <form method="POST" action="../index.php?action=signup" class="signup">
            <span class="text-center">Sign Up</span>
        <div class="input-container">
            <input type="text" name="sign-u"/>
            <label>Username</label>		
        </div>
        <div class="input-container">
            <input type="text" name="sign-e"/>
            <label>Email</label>
        </div>
        <div class="input-container">		
            <input type="mail" name="sign-p"/>
            <label>Password</label>
        </div>
        <div class="input-container">		
            <input type="mail" name="sign-cp"/>
            <label>Confirm Password</label>
        </div>
            <button type="button" class="btn">Log In</button>
    <!-- signup button -->
            <a href="login.php" class="btn">Sign Up</a>
            <input type="submit" value="Submit">
        </form>	
    </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>


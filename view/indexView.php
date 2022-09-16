<?php $title = "Journey"; ?>

<?php ob_start(); ?>
    <section>
        <header>
            <h2><a href="#">Logo</a></h2>
            <div class="navbar">
                <a href="#">About us</a>
                <a href="#">Features</a>
                <a href="#">Pricing</a>
            </div>
        </header>
        <div class="content">
            <div class="info">
                <h2>
                Dear Diary. <br>Your journal for life..
                </h2>
                <p>
                Aenean eleifend, justo quis ultrices semper, nibh lorem commodo felis, 
                et luctus purus urna nec quam. Nam pharetra, dui nec finibus hendrerit, 
                sapien nisi pellentesque tellus, quis elementum arcu eros id diam. Nulla 
                imperdiet dapibus viverra. Nulla arcu augue, pulvinar faucibus urna et, 
                aliquam mollis odio. Ut feugiat posuere arcu, vel commodo eros gravida ut. 
                Suspendisse congue eleifend quam id mattis. Suspendisse ut nunc auctor, 
                fringilla diam sit amet, molestie felis. Aenean a lobortis elit. Donec ac 
                mattis augue, ut scelerisque mauris. Donec leo nibh, tristique in finibus 
                vel, feugiat at sapien. Curabitur suscipit condimentum lacus. Nunc non turpis 
                sit amet nisi dictum gravida. Aliquam tristique elit leo, in aliquet tellus 
                posuere sed. Aenean quis arcu ut diam tincidunt molestie eu vitae nisl.
                </p>
            </div>
        </div>
    </section>
<?php $content = ob_get_clean(); ?>

<?php require("templateView.php"); ?>
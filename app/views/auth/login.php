<section class="account">
    <div class="container">
        <div class="Register">
            <div class="reg-title">
                <!-- echo out the system feedback (error and success messages) -->
                <?php View::renderFeedbackMessages(); ?>
                <h2 class="title">Login</h2>
            </div>
            <form action="<?php echo URL; ?>/user/authenticate" method="post">
                <label>E-mail  </label><br><input type = "text" name = "email" class = "box"/><br /><br />
                <!-- <span class = "error"><?php echo $name_error;?></span><br/><br /> -->
                <label>Password  </label><br><input type = "password" name = "password" class = "box"/>
                <!-- <span class = "error"><?php echo $passwordErr;?></span><br/><br /> -->
                <div class="submit"><button type="submit"  name="submit_login_user" value = " Submit " class="btn btn-orange">LOGIN</button></div>
                <div><a href="<?php echo URL; ?>/user/register">Sign Up</a></div>
                <!-- <div><a href="<?php echo URL; ?>/user/forgot">Forgot Username or Password</a></div> -->
            </form>
        </div>
    </div>
</section>
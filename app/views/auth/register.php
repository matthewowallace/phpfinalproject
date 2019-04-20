<div class="">
    <section class="account">
        <div class="container">
            <div class="Register">
                <div class="reg-title">
                    <!-- echo out the system feedback (error and success messages) -->
                    <?php View::renderFeedbackMessages(); ?>
                    <h2>SIGN UP</h2>
                </div>
                <form action="<?php echo URL; ?>/user/store" method="post">
                    <label>UserName  </label><br>
                    <input type = "text" name = "username" class = "box"/><br /><br />
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="" />
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="" />
                    <!-- <span class = "error"><?php echo $name_error;?></span><br/><br /> -->
                    <label>Password  </label><br><input type = "password" name = "password" class = "box"/>
                    <!-- <span class = "error"><?php echo $passwordErr;?></span><br/><br /> -->
                    <label>Re-enter Password  </label><br><input type = "password" name ="cpassword" class = "box"/><br/><br />
                    <label>Email </label><br><input type = "email" name ="email" class = "box" required/><br/><br />
                    <br>
                    <!-- <span class="in_form">
                        <div class="radio-group">
                            <div class="reg-title"><h2>Subscription</h2></div>
                            <label for="is_subscriber">Subscriber</label>
                            <input type="radio" id="is_subscriber" name="is_subscriber" value="yes">
                            <label for="is_contributer">Contributer</label>
                            <input type="radio" name="is_subscriber" id="is_contributer" value="no">
                        </div>
                    </span> -->
                    <!-- <span class = "error"><?php echo $emailErr;?></span><br/><br /> -->
                    <div class="input_field checkbox_option">
                    <div class="con">
                        <label for="cb1">I agree with terms and conditions <input type="checkbox" id="cb1" required></label>
                    </div>
                    <div class="submit">
                        <button type="submit" name="submit_register_user" value = " Submit " class="btn btn-orange">SIGN UP</button>
                    </div>
                    <div><a href="<?php echo URL; ?>/user/login">Already Registered Login</a></div>
                    <!-- <div><a href="<?php echo URL; ?>/user/forgot">Forgot Username or Password</a></div> -->
                </form>
            </div>
        </div>
    </section>
</div>
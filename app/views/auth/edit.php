<div class="">
    <section class="account">
        <div class="container">
            <div class="Register">
                <div class="reg-title">
                    <!-- echo out the system feedback (error and success messages) -->
                    <?php View::renderFeedbackMessages(); ?>
                    <h2>UPDATE ACCOUNT</h2>
                </div>
                <form action="<?php echo URL . '/user/update/' . htmlspecialchars($this->user->id, ENT_QUOTES, 'UTF-8'); ?>" method="post">
                    <label>UserName  </label><br>
                    <input type = "text" name = "username" class = "box" value="<?= $this->user->username ?>"/><br /><br />
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="" value="<?= $this->user->first_name ?>"/>
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="" value="<?= $this->user->last_name ?>"/>
                    <!-- <span class = "error"><?php echo $name_error;?></span><br/><br /> -->
                    <label>Password  </label><br><input type = "password" name = "password" class = "box"/>
                    <!-- <span class = "error"><?php echo $passwordErr;?></span><br/><br /> -->
                    <label>Re-enter Password  </label><br><input type = "password" name ="cpassword" class = "box"/><br/><br />
                    <label>Email </label><br><input type = "email" name ="email" class = "box" required value="<?= $this->user->email ?>"/><br/><br />
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
                                      
                    <div class="submit">
                        <button type="submit" name="submit_update_user" value = " Update " class="btn btn-orange">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
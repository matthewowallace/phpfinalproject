<div class="">
    <section class="account">
        <div class="container">
            <div class="Register">
                <div class="reg-title">
                    <!-- echo out the system feedback (error and success messages) -->
                    <?php View::renderFeedbackMessages(); ?>
                    <h2>SIGN UP</h2>
                </div>
                <form action="<?php echo URL; ?>/user/agree" method="post">
                    <h2>Terms of agreement</h2>
                    <p>
                        As a contributer you will be able to sell products and post to the fitness bar.
                    </p>
                    <div class="input_field checkbox_option">
                        <label for="cb1">I agree with terms and conditions <input type="checkbox" id="cb1" name="agree" value="1" required></label>
                    <div class="submit">
                        <button type="submit" name="submit_upgrade_user" value = " Submit " class="btn btn-orange">Upgrade Account</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
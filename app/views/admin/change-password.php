<div class="wrapper">
    <div class="container">
        <div class="row">

            <!-- echo out the system feedback (error and success messages) -->
            <?php View::renderFeedbackMessages(); ?>

            <!-- echo out the admin bar -->
            <?php View::renderSideBar(); ?>

            <div class="span9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3><?= $this->user ? 'Update user' : 'Add User' ?></h3>
                        </div>
                        <div class="module-body table">
                            <div class="admin-form">
                                <form action="<?php echo URL . 'admin/change'; ?>" method="post">
                                    <div class="">
                                        <div class="form-group col-md-6">
                                            <label>Password  </label><br><input type = "password" name = "password" class = "box"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Re-enter Password  </label><br><input type = "password" name ="cpassword" class = "box"/>
                                        </div>
                                    </div>
                                    <div class="mb-5 submit">
                                        <button class="btn btn-primary" type="submit" name="submit_change_user_admin" value = " Submit " class="btn btn-orange"><?= $this->user ? 'Update user' : 'Create user' ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
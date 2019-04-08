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
                                <form action="<?php echo URL . ($this->user ? '/admin/users/update' : '/admin/users/add'); ?>" method="post">
                                    <input type="hidden" name="user_id" value="<?= $this->user->id ?>">
                                    <label>Username  </label>
                                    <input type = "text" name = "username" class = "box" value="<?= $this->user ? $this->user->username : '' ?>"/>
                                    <div class="">
                                        <div class="form-group col-md-6">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" placeholder="" value="<?= $this->user ? $this->user->first_name : '' ?>"/>                    
                                       </div>
                                       <div class="form-group col-md-6">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" placeholder=""  value="<?= $this->user ? $this->user->last_name : '' ?>"/>
                                       </div>
                                    </div>
                                    <div class="">
                                        <div class="form-group col-md-6">
                                            <label>Password  </label><br><input type = "password" name = "password" class = "box"/>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Re-enter Password  </label><br><input type = "password" name ="cpassword" class = "box"/>
                                        </div>
                                    </div>
                                    <label>Email </label><br><input type = "email" name ="email" class = "box" required value="<?= $this->user ? $this->user->email : '' ?>"/>
                                    <span class="in_form">
                                        <div class="checkbox-group">
                                            <div class="reg-title"><h2>User Roles</h2></div>
                                            <label class="role-label" for="is_admin">Admin <input type="checkbox" id="is_admin" name="is_admin" value="1" <?= $this->user && $this->user->is_admin ? 'checked' : '' ?>></label>
                                            <label class="role-label" for="is_subscriber">Subscriber <input type="checkbox" id="is_subscriber" name="is_subscriber" value="1" <?= $this->user && $this->user->is_subscriber ? 'checked' : '' ?>></label>
                                            <label class="role-label" for="is_contributer">Contributer <input type="checkbox" name="is_contributer" id="is_contribute-r" value="1" <?= $this->user && $this->user->is_contributer ? 'checked' : '' ?>></label>
                                        </div>
                                    </span>
                                    <input type="file" name="image" />
                                    <div class="mb-5 submit">
                                        <button class="btn btn-primary" type="submit" name="submit_add_user_admin" value = " Submit " class="btn btn-orange"><?= $this->user ? 'Update user' : 'Create user' ?></button>
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
<div class="bg">
    <div class="container">
        <!-- echo out the system feedback (error and success messages) -->
        <?php View::renderFeedbackMessages(); ?>

        <div class="row">
            <h1>Products</h1>
        </div>
        <div class="row">
            <form action="<?php echo URL . '/partners/update/' . htmlspecialchars($this->partner->id, ENT_QUOTES, 'UTF-8'); ?>" method="post" class="form clearfix newform" enctype="multipart/form-data">
                <br>
                <span class="in_form">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name" required value="<?= $this->partner->name ?>">
                </span>
                <br>
                <span class="in_form">
                    <label for="url">Address</label>
                    <textarea rows="4" cols="50" name="address" placeholder="Address"><?= $this->partner->address ?></textarea>
                </span>
               <br>
                <span class="in_form">
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact-no" placeholder="Contact" value="<?= $this->partner->contact ?>">
                </span>
                <br>
                <span class="in_form">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?= $this->partner->email ?>">
                </span>
                <br>
                <input type="file" name="image" />

                <span class="form__btn--group">
                    <input type="submit" value="Update Partner" class="btn btn-orange" name="submit_update_partner">
                </span>
            </form>
        </div>
    </div>
</div>
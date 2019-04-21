<div class="bg">
 
        <!-- echo out the system feedback (error and success messages) -->
        <?php View::renderFeedbackMessages(); ?>
   
     <div class="container">
              <div class="profile-text">
            <h3>Add partner</h3>
        </div>
        <div class="row-fluid">
            <form class="fill" action="<?= URL ?>/partners/store" method="post" class="form clearfix newform"  enctype="multipart/form-data">
                <br>
                <span class="in_form">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Name" required>
                </span>
                <br>
                <span class="in_form">
                    <label for="url">Address</label>
                    <textarea rows="4" cols="50" name="address" placeholder="Address"></textarea>
                </span>
               <br>
                <span class="in_form">
                    <label for="contact">Contact</label>
                    <input type="text" name="contact" id="contact-no" placeholder="Contact">
                </span>
                <br>
                <span class="in_form">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email">
                </span>
                <br>
                <input type="file" name="image" />

                <span class="form__btn--group">
                    <input type="submit" value="Add Partner" class="btn btn-orange" name="submit_add_partner">
                </span>

            </form>
        </div>
    </div>
 
</div>
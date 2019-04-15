<div class="bg">
 
        <!-- echo out the system feedback (error and success messages) -->
        <?php View::renderFeedbackMessages(); ?>
   
  
     <div class="container">
              <div class="profile-text">
            <h3>Promotions</h3>
        </div>
        <div class="row-fluid">
            <form class="fill" action="<?= URL ?>/fitnessbar/store" method="post" class="form clearfix newform"  enctype="multipart/form-data">
                <br>
                <span class="in_form">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Product Description" required>
                </span>
                <br>
                <span class="in_form">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" placeholder="URL">
                </span>
               <br>
                <span class="in_form">
                    <label for="cost">Cost</label>
                    <input type="text" name="cost" id="cost" placeholder="Cost">
                </span>
                <br>
                <span class="in_form">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" placeholder="Start date">
                </span>
                <br>
                <span class="in_form">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" placeholder="End date">
                </span>
                 <br>
                <span>
                    <div class="radio-group">
                        <label for="">Promotion Status: </label>
                        <label for="status-active">Active</label>
                        <input type="radio" id="status-active" name="is_active" value="1">
                        <label for="status-inactive">In-active</label>
                        <input type="radio" name="is_active" id="status-inactive" value="0">
                    </div>
                </span>
                <br>
                <input type="file" name="image" />

                <span class="form__btn--group">
                    <input type="submit" value="Add Promotion" class="btn btn-orange" name="submit_add_ad">
                </span>

            </form>
        </div>
    </div>
 
</div>
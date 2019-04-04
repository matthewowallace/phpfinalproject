<div class="bg">
 
        <!-- echo out the system feedback (error and success messages) -->
        <?php View::renderFeedbackMessages(); ?>
   
  
     <div class="container">
              <div class="profile-text">
            <h3>Promotions</h3>
        </div>
        <div class="row-fluid">
            <form class="fill" action="<?php echo URL . '/fitnessbar/update/' . htmlspecialchars($this->ad->id, ENT_QUOTES, 'UTF-8'); ?>" method="post" class="form clearfix newform"  enctype="multipart/form-data">
                <span class="in_form">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Product Description" required value="<?= $this->ad->description ?>">
                </span>

                <span class="in_form">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" placeholder="URL" value="<?= $this->ad->url ?>">
                </span>

                <span class="in_form">
                    <label for="cost">Cost</label>
                    <input type="text" name="cost" id="cost" placeholder="Cost" value="<?= $this->ad->cost ?>">
                </span>

                <span class="in_form">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" placeholder="Start date" value="<?= $this->ad->start_date ?>">
                </span>

                <span class="in_form">
                    <label for="end_date">End Date</label>
                    <input type="date" name="end_date" id="end_date" placeholder="End date" value="<?= $this->ad->end_date ?>">
                </span>
                 <br>
                <span class="in_form">
                   
                    <div class="radio-group">
                        <label for="">Promotion Status: </label>
                        <label for="status-active">Active</label>
                        <input type="radio" id="status-active" name="is_active" value="1" <?= $this->ad->is_active == 1 ? 'checked' : '' ?>>
                        <label for="status-inactive">In-active</label>
                        <input type="radio" name="is_active" id="status-inactive" value="0" <?= $this->ad->is_active == 1 ? '' : 'checked' ?>>
                    </div>
                </span>

                <input type="file" name="image" />

                <span class="form__btn--group">
                    <input type="submit" value="Update Promotion" class="btn btn-orange" name="submit_update_ad">
                </span>

            </form>
        </div>
    </div>
 
</div>
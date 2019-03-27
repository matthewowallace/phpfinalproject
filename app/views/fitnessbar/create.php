<div class="row bg">
    <div class="container">
        <!-- echo out the system feedback (error and success messages) -->
        <?php View::renderFeedbackMessages(); ?>

        <div class="row">
            <h1>Products</h1>
        </div>
        <div class="row">
            <form action="<?= URL ?>/fitnessbar/store" method="post" class="form clearfix newform"  enctype="multipart/form-data">
                <span class="in_form">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Product Description" required>
                </span>

                <span class="in_form">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" placeholder="URL">
                </span>

                <span class="in_form">
                    <label for="cost">Cost</label>
                    <input type="text" name="cost" id="cost" placeholder="Cost" required>
                </span>

                <span class="in_form">
                    <label for="start_date">Cost</label>
                    <input type="date" name="start_date" id="start_date" placeholder="Start date">
                </span>

                <span class="in_form">
                    <label for="end_date">Cost</label>
                    <input type="date" name="end_date" id="end_date" placeholder="End date">
                </span>

                <span class="in_form">
                    <label for="">Promotion Status: </label>
                    <div class="radio-group">
                        <label for="status-active">Active</label>
                        <input type="radio" id="status-active" name="is_active" value="1">
                        <label for="status-inactive">In-active</label>
                        <input type="radio" name="is_active" id="status-inactive" value="0">
                    </div>
                </span>

                <input type="file" name="image" />

                <span class="form__btn--group">
                    <input type="submit" value="Add Promotion" class="btn btn-orange" name="submit_add_ad">
                </span>

            </form>
        </div>
    </div>
</div>
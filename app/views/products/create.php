<div class="container bg">
    <!-- echo out the system feedback (error and success messages) -->
    <?php View::renderFeedbackMessages(); ?>

    <div class="row">
        <h1>Products</h1>
    </div>
    <div class="row">
        <form action="<?= URL ?>/product/store" method="post" class="form clearfix newform">
            <span class="in_form">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" placeholder="Product Description" required>
            </span>

            <span class="in_form">
                <label for="cost">Cost</label>
                <input type="text" name="cost" id="cost" placeholder="Cost" required>
            </span>

            <span class="in_form">
                <label for="category">Category: </label>
                <select id="category" name="category">
                    <option value="" selected>Choose Category</option>
                    <?php //foreach ($this->categories as $category) : ?>
                    <?php foreach ($this->categories as $id => $category) : ?>
                    <option value="<?= $id?>"><?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endforeach; ?>
                </select>
            </span>

            <span class="in_form">
                <label for="">Product Status: </label>
                <div class="radio-group">
                    <label for="status-active">Public</label>
                    <input type="radio" id="status-active" name="is_public" value="1">
                    <label for="status-inactive">Hidden</label>
                    <input type="radio" name="is_public" id="status-inactive" value="0">
                </div>
            </span>

            <span class="form__btn--group">
                <input type="submit" value="Add Product" class="btn btn-orange" name="submit_add_product">
            </span>

        </form>
    </div>
</div>
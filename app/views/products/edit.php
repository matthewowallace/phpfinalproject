<div class="bg">
    <div class="container">
        <!-- echo out the system feedback (error and success messages) -->
        <?php View::renderFeedbackMessages(); ?>

        <div class="row">
            <h1>Products</h1>
        </div>
        <div class="row">
            <form action="<?php echo URL . '/inventory/update/' . htmlspecialchars($this->product->id, ENT_QUOTES, 'UTF-8'); ?>" method="post" class="form clearfix newform" enctype="multipart/form-data">
                <span class="in_form">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" placeholder="Product name" required value="<?= $this->product->product_name ?>">
                </span>

                <span class="in_form">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" placeholder="Product Description" required value="<?= $this->product->description ?>">
                </span>

                <span class="in_form">
                    <label for="cost">Cost</label>
                    <input type="text" name="cost" id="cost" placeholder="Cost" required value="<?= $this->product->cost ?>">
                </span>

                <span class="in_form">
                    <label for="category">Category: </label>
                    <select id="category" name="category">
                        <option value="" selected>Choose Category</option>
                        <?php //foreach ($this->categories as $category) : ?>
                        <?php foreach ($this->categories as $category) : ?>
                        <option value="<?= $category->id ?>" <?= $this->product->category_id == $category->id ? 'selected' : '' ?>><?php echo htmlspecialchars($category->category_name, ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php endforeach; ?>
                    </select>
                </span>

                <span class="in_form">
                    <label for="">Product Status: </label>
                    <div class="radio-group">
                        <label for="status-active">Active</label>
                        <input type="radio" id="status-active" name="is_public" value="1" <?= $this->product->is_public == 1 ? 'checked' : '' ?>>
                        <label for="status-inactive">In-active</label>
                        <input type="radio" name="is_public" id="status-inactive" value="0" <?= $this->product->is_public == 1 ? '' : 'checked' ?>>
                    </div>
                </span>

                <input type="file" name="image" />

                <span class="form__btn--group">
                    <input type="submit" value="Update Product" class="btn btn-orange" name="submit_update_product">
                </span>

            </form>
        </div>
    </div>
</div>
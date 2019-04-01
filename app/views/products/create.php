<div class="bg">
        <!-- echo out the system feedback (error and success messages) -->
        <?php View::renderFeedbackMessages(); ?>

    
          
        
        <div class="container">
              <div class="profile-text">
            <h3>Products</h3>
        </div>
        <div class="row-fluid">
            <form  class="fill" action="<?= URL ?>/inventory/store" method="post" class="form clearfix newform"  enctype="multipart/form-data">
                <span class="in_form">
                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" id="product_name" placeholder="Product name" required>
                </span>

                <span class="in_form">
                    <label  for="description">Description</label>
                    <textarea  name="description" id="description" placeholder="Product description" required></textarea>
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
                        <?php foreach ($this->categories as $category) : ?>
                        <option value="<?= $category->id?>"><?php echo htmlspecialchars($category->category_name, ENT_QUOTES, 'UTF-8'); ?></option>
                        <?php endforeach; ?>
                    </select>
                </span>

                <span class="in_form">
                   
                    <div class="radio-group">
                         <label for="">Product Status: </label>
                        <label for="status-active">Active</label>
                        <input type="radio" id="status-active" name="is_public" value="1">
                        <label for="status-inactive">In-active</label>
                        <input type="radio" name="is_public" id="status-inactive" value="0">
                    </div>
                </span>

                <input type="file" name="image" />

                <span class="form__btn--group">
                    <input type="submit" value="Add Product" class="btn btn-orange" name="submit_add_product">
                </span>

            </form>
        </div>
    </div>
    
</div>
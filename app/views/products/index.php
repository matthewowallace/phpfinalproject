<div>
    <!-- echo out the admin bar -->
    <?php View::renderAdminBar('inventory'); ?>

    <!-- echo out the system feedback (error and success messages) -->
    <?php View::renderFeedbackMessages(); ?>

    <div id="Products" class="tabcontent" style="display: block;">
        <div class="profile-text">
            <h3>Products</h3>
            <span><a href="<?= URL ?>/inventory/create" class="opt">Add Product</a></span>
            <form  method="POST" action="<?php echo URL . '/inventory'; ?>" accept-charset="UTF-8" style="display: inline-block;">
                <input class="Search" name="q" placeholder="Search" value="<?= !empty($this->q) ? $this->q : '' ?>" type="text">
                <input class="Searchbtn" value="Search" type="submit" name="submit_search_inventory">
            </form>
        </div>
<div class="container">
        <table>
            <tr>
                <th>&nbsp;</th>
                <!-- <th>Product ID</th> -->
                <th>Product</th>
                <th>Description</th>
                <th>Price</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
            <?php foreach ($this->products as $product) : ?>
                <tr>
                    <td><img class="prod-img" src="<?= $product->prod_image_path ?>" alt=""></td>
                    <!--<td><?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?></td>-->
                    <td><?php echo htmlspecialchars($product->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>$<?php echo htmlspecialchars($product->cost, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product->category, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo $product->is_public ? 'Active' : 'In-active'; ?></td>
                    <td class="edit">
                        <?php $url = URL . '/inventory/edit/' . $product->id; ?>
                        <a href="<?= $url ?>" class="option">Edit
                           
                        </a>
                        <form  method="POST" action="<?php echo URL . '/inventory/delete/' . htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                            <input name="_method" value="DELETE" type="hidden">
                            <input value="Delete" type="submit" name="submit_delete_product" >
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tfoot>
                <?php if (count($this->products) == 0) : ?>
                <tr>
                    <th>&nbsp;</th>
                    <th colspan="4">No products found</th>
                </tr>
                <?php endif; ?>
            </tfoot>
        </table>
     </div>
    </div>
</div>
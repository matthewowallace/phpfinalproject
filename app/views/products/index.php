<div>
    <div class="tab">
        <a class="tablinks" href="<?= URL ?>/user/profile">Dashboard</button>
        <a class="tablinks active" href="<?= URL ?>/product">Products</button>
        <!-- <button class="tablinks" onclick="openCity(event, 'Subscription')">Add Subscription</button> -->
    </div>

    <!-- echo out the system feedback (error and success messages) -->
    <?php View::renderFeedbackMessages(); ?>

    <div id="Products" class="tabcontent" style="display: block;">
        <div class="profile-text">
            <h3>Products</h3>
            <span><a href="<?= URL ?>/product/create" class="opt">Add Product</a></span>
        </div>

        <table>
            <tr>
                <th>&nbsp;</th>
                <th>Product ID</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Description</th>
                <th>Price</th>
                <th>Edit</th>
            </tr>
            <?php foreach ($this->products as $product) : ?>
                <tr>
                    <td><img src="<?= $product->prod_image_path ?>" alt=""></td>
                    <td><?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product->category, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>$<?php echo htmlspecialchars($product->cost, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="edit">
                        <!-- <?php $url = URL . '/product/edit/' . $product->id; ?>
                        <a href="<?= $url ?>" class="opt">Edit
                            <i class="ion-edit btn-small"></i>
                        </a> -->
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
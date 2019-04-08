<div>
    <!-- echo out the admin bar -->
    <?= $this->show_bar ? View::renderAdminBar('orders') : ''; ?>

    <!-- echo out the system feedback (error and success messages) -->
    <?php View::renderFeedbackMessages(); ?>

    <div id="Products" class="tabcontent" style="display: block;">
        <div class="profile-text">
            <h3>My Orders</h3>
        </div>
    <div class="container">
        <?php foreach ($this->orders as $key => $groups) : ?>
            <ul class="order">
                <li><h5>Ordered <?= $key ?></h5></li>
                <?php foreach ($groups as $order) :
                    $subtotal = (float)$order->cost * (int)$order->quantity; ?>
                
                    <li><img class="prod-img" src="<?= $order->prod_image_path ?>" alt=""><?php echo $order->product_name . ' x' . $order->quantity . ' $' . $subtotal; ?></li>
            
                <?php endforeach; ?>   
             </ul>         
        <?php endforeach; ?>

        <!-- <table>
            <tr>
                <th>Product</th>
                <th>Ordered</th>
                <th>Price</th>
            </tr>
            <?php foreach ($this->orders as $order) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($order->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($order->order_date, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>$<?php echo htmlspecialchars($order->cost, ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
            <?php endforeach; ?>
            <tfoot>
                <?php if (count($this->orders) == 0) : ?>
                <tr>
                    <th>&nbsp;</th>
                    <th colspan="4">No orders found</th>
                </tr>
                <?php endif; ?>
            </tfoot>
        </table> -->
     </div>
</div>
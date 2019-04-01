<div>
    <!-- echo out the system feedback (error and success messages) -->
    <?php View::renderFeedbackMessages(); ?>

    <div id="Products" class="tabcontent" style="display: block;">
        <div class="profile-text">
            <h3>Shopping Cart</h3>
        </div>
    <div class="container">
        <table>
            <tr>
                <th>&nbsp;</th>
                <th>Product</th>
                <th>Cost</th>
                <th>Total</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($this->shopping_cart as $cart) : ?>
                <tr>
                    <td><img class="prod-img" src="<?= $cart->prod_image_path ?>" alt=""></td>
                    <td><?php echo htmlspecialchars($cart->product_name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>$<?php echo htmlspecialchars($cart->cost, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars( 'x' . $cart->quantity . ' $' . $cart->total, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="edit">
                        <form  method="POST" action="<?php echo URL . '/cart/delete/' . htmlspecialchars($cart->id, ENT_QUOTES, 'UTF-8'); ?>" accept-charset="UTF-8" style="display: inline-block;">
                            <input name="_method" value="DELETE" type="hidden">
                            <input value="Remove" type="submit" name="submit_remove_product" >
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tfoot>
                <?php if (count($this->shopping_cart) == 0) : ?>
                <tr>
                    <th>&nbsp;</th>
                    <th colspan="4">No items found in cart</th>
                </tr>
                <?php endif; ?>
            </tfoot>
        </table>
        <?php if ($this->shopping_cart) : ?>
        <div class="row mt-3 ml-0">
            <form  method="POST" action="<?php echo URL . '/cart/checkout'; ?>" accept-charset="UTF-8" style="display: inline-block;">
                <input name="_method" value="DELETE" type="hidden">
                <input value="Checkout" type="submit" name="submit_checkout_cart" >
            </form>
        </div>
        <?php endif; ?>
         </div>
    </div>
</div>
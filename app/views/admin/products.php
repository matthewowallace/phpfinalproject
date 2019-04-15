<div class="wrapper">
    <div class="container">
        <div class="row">
            
            <!-- echo out the system feedback (error and success messages) -->
            <?php View::renderFeedbackMessages(); ?>

            <!-- echo out the admin bar -->
            <?php View::renderSideBar(); ?>

            <div class="span9">
                <div class="content">

                    <div class="module">
                        <div class="module-head">
                            <h3>Manage Products</h3>
                        </div>
                        <div class="module-body table">
                            <?php if(isset($_GET['del']))
                            {?>
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Oh snap!</strong>   <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                                </div>
                            <?php } ?>

                            <br />


                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                <thead>
                                    <tr>
                                        <th>&nbsp;</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <?php $url = URL . 'admin/products/edit/' . $product->id; ?>
                                          <!--   <a href="<?= $url ?>" class="option">Edit
                                               
                                            </a>
                                            <form  method="POST" action="<?php echo URL . 'admin/products/delete/' . htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                                                <input name="_method" value="DELETE" type="hidden">
                                                <input value="Delete" type="submit" name="submit_delete_product" >
                                            </form> -->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--/.content-->
            </div><!--/.span9-->
        </div>
    </div>
</div>
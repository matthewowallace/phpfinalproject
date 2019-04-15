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
                            <h3>Brands</h3>
                        </div>
                        <div class="admin-form">
                            <form  class="fill" action="<?= URL ?>/admin/brand/add" method="post" class="form clearfix newform">

                                 <br>
                                 <br>
                                 <span class="in_form">
                                    <label for="product_name">Brand Name</label>
                                    <input type="text" name="brand_name" id="product_name" placeholder="Brand name" required>
                                </span>
                               <span class="form__btn--group">
                                    <input type="submit" value="Add Brand" class="btn btn-orange" name="submit_add_product">
                                </span>
                            </form>
                            <hr>
                        </div>
                        <div class="module-body table">
                            <br />
                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($this->brands as $brand) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($brand->brand_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><form  method="POST" action="<?php echo URL . '/admin/brand/delete/' . htmlspecialchars($brand->id, ENT_QUOTES, 'UTF-8'); ?>" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                            <input name="_method" value="DELETE" type="hidden">
                            <input value="Delete" type="submit" name="submit_delete_product" >
                        </form></td>
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
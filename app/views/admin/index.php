<div class="wrapper">
    <div class="container">
        <div class="row">
            
            <!-- echo out the admin bar -->
            <?php View::renderSideBar(); ?>

            <div class="span9">
                <div class="content">

                    <div class="module">
                        <div class="module-head">
                            <h3>Manage Users</h3>
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
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Subscription</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($this->users as $user) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php echo $user->is_admin ? 'Admin</br>' : ''; ?>
                                            <?php echo $user->is_contributer ? 'Contributer</br>' : ''; ?>
                                            <?php echo $user->is_subscriber ? 'Subscriber</br>' : ''; ?>
                                        </td>
                                        <td>
                                            <?php echo 'Start: ' . htmlspecialchars($user->subscription_start, ENT_QUOTES, 'UTF-8') . '</br>'; ?>
                                            <?php echo 'Ends: ' . htmlspecialchars($user->subscription_end, ENT_QUOTES, 'UTF-8'); ?>
                                        </td>
                                        <td class="edit">
                                            <?php $url = URL . '/admin/users/edit/' . $user->id; ?>
                                            <a href="<?= $url ?>" class="option">Edit
                                               
                                            </a>
                                            <form  method="POST" action="<?php echo URL . '/admin/users/delete/' . htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8'); ?>" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                                                <input name="_method" value="DELETE" type="hidden">
                                                <input value="Delete" type="submit" name="submit_delete_product" >
                                            </form>
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
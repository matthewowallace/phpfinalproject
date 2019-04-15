<!-- Start sidebar -->
<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li>
                <a class="collapsed" data-toggle="" href="#">
                    <i class="menu-icon icon-group"></i>
                    <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
                    Manage users
                </a>
                <ul id="togglePages" class="unstyled">
                    <li>
                        <a href="<?= URL ?>admin/users">
                            <i class="icon-tasks"></i>
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="<?= URL ?>admin/users/add">
                            <i class="icon-tasks"></i>
                            Add User
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <ul class="widget widget-menu unstyled">
            <li><a href="<?= URL ?>admin/contacts"><i class="menu-icon icon-tasks"></i>Contacts</a></li>
            <li><a href="<?= URL ?>admin/category"><i class="menu-icon icon-tasks"></i>Categories </a></li>
            <li><a href="<?= URL ?>admin/brand"><i class="menu-icon icon-tasks"></i>Brands </a></li>
            <li>
                <a href="<?= URL ?>admin/products"><i class="menu-icon icon-paste"></i>Products</a>
            </li>
            <!-- <li><a href="manage-products.php"><i class="menu-icon icon-table"></i>Manage Products </a></li> -->
        </ul><!--/.widget-nav-->

        <ul class="widget widget-menu unstyled">
            <!-- <li><a href="user-logs.php"><i class="menu-icon icon-tasks"></i>User Login Log </a></li> -->
            <li>
                <a href="<?php echo URL; ?>">
                    <i class="icon-tasks"></i>
                    Visit Site
                </a>
                <a href="<?php echo URL; ?>user/logout">
                    <i class="menu-icon icon-signout"></i>
                    Logout
                </a>
            </li>
        </ul>

    </div><!--/.sidebar-->
</div><!--/.span3-->
<!-- End sidebar -->
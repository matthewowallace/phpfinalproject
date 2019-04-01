<div>
    <!-- echo out the admin bar -->
    <?php View::renderAdminBar('bar'); ?>

    <!-- echo out the system feedback (error and success messages) -->
    <?php View::renderFeedbackMessages(); ?>

    <div id="Products" class="tabcontent" style="display: block;">
        <div class="profile-text">
            <h3>My Promotions</h3>
            <span><a href="<?= URL ?>/fitnessbar/create" class="opt">Add promotion</a></span>
            <form method="POST" action="<?php echo URL . '/fitnessbar'; ?>" accept-charset="UTF-8" style="display: inline-block;">
                <input class="Search" name="q" placeholder="Search" value="<?= !empty($this->q) ? $this->q : '' ?>" type="text">
                <input class="Searchbtn" value="Search" type="submit" name="submit_search_ad">
            </form>
        </div>
<div class="container">
        <table>
            <tr>
                <th>&nbsp;</th>
                <th>Promotion ID</th>
                <th>Description</th>
                <th>Start</th>
                <th>Ending</th>
                <th>Price</th>
                <th>Status</th>
                <th>Edit</th>
            </tr>
            <?php foreach ($this->ads as $ad) : ?>
                <tr>
                    <td><img class="prod-img" src="<?= $ad->file_path ?>" alt=""></td>
                    <td><?php echo htmlspecialchars($ad->id, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($ad->description, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($ad->start_date, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($ad->end_date, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>$<?php echo htmlspecialchars($ad->cost, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo $ad->is_active ? 'Active' : 'In-active'; ?></td>
                    <td class="edit">
                        <?php $url = URL . '/fitnessbar/edit/' . $ad->id; ?>
                        <a href="<?= $url ?>" class="option">Edit
                            <i class="ion-edit btn-small"></i>
                        </a>
                        <form method="POST" action="<?php echo URL . '/fitnessbar/delete/' . htmlspecialchars($ad->id, ENT_QUOTES, 'UTF-8'); ?>" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                            <input name="_method" value="DELETE" type="hidden">
                            <input value="Delete" type="submit" name="submit_delete_ad">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tfoot>
                <?php if (count($this->ads) == 0) : ?>
                <tr>
                    <th>&nbsp;</th>
                    <th colspan="4">No ads found</th>
                </tr>
                <?php endif; ?>
            </tfoot>
        </table>
    </div>
    </div>
</div>
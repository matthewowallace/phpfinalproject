<div>
    <!-- echo out the admin bar -->
    <?= $this->show_bar ? View::renderAdminBar('partners') : ''; ?>

    <!-- echo out the system feedback (error and success messages) -->
    <?php View::renderFeedbackMessages(); ?>

    <div id="Partners" class="tabcontent" style="display: block;">
        <div class="profile-text">
            <h3>Partners</h3>
            <span><a href="<?= URL ?>partners/create" class="opt">Add Partner</a></span>
            <form  method="POST" action="<?php echo URL . 'partners'; ?>" accept-charset="UTF-8" style="display: inline-block;">
                <input class="Search" name="q" placeholder="Search" value="<?= !empty($this->q) ? $this->q : '' ?>" type="text">
                <input class="Searchbtn" value="Search" type="submit" name="submit_search_partner">
            </form>
        </div>
    <div class="container">
        <table>
            <tr>
                <th>&nbsp;</th>
                <th>Partner</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>User</th>
                <th>Edit</th>
            </tr>
            <?php foreach ($this->partners as $partner) : ?>
                <tr>
                    <td><img class="prod-img" src="<?= $partner->image_path ?>" alt=""></td>
                    <!--<td><?php echo htmlspecialchars($partner->id, ENT_QUOTES, 'UTF-8'); ?></td>-->
                    <td><?php echo htmlspecialchars($partner->name, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($partner->address, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($partner->contact, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($partner->email, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($partner->username, ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="edit">
                        <?php $url = URL . 'partners/edit/' . $partner->id; ?>
                        <a href="<?= $url ?>" class="option">Edit
                           
                        </a>
                        <form  method="POST" action="<?php echo URL . 'partners/delete/' . htmlspecialchars($partner->id, ENT_QUOTES, 'UTF-8'); ?>" accept-charset="UTF-8" style="display: inline-block;" onsubmit="return confirm('Are you sure?');">
                            <input name="_method" value="DELETE" type="hidden">
                            <input value="Delete" type="submit" name="submit_delete_partner" >
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tfoot>
                <?php if (count($this->partners) == 0) : ?>
                <tr>
                    <th>&nbsp;</th>
                    <th colspan="4">No partners found</th>
                </tr>
                <?php endif; ?>
            </tfoot>
        </table>
     </div>
    </div>
</div>
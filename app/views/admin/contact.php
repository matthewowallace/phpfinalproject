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
                            <h3>Contact Us</h3>
                        </div>
                        <div class="module-body table">
                            <br />
                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped  display" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($this->contacts as $contact) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($contact->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($contact->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($contact->message, ENT_QUOTES, 'UTF-8'); ?></td>
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
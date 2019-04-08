  <div id="contact">
    <div class="cover-1">
        <div class="container">
            <div class="row">
                <div class="col-md-4 wow fadeInUp" data-wow-offset="0" data-wow-delay="0.6s">
                    <div id="sendmessage">
                        <!-- echo out the system feedback (error and success messages) -->
                        <?php View::renderFeedbackMessages(); ?>
                    </div>
                    <div id="errormessage"></div>
                    <form action="<?= URL ?>/contact/store" id="quick-contact" method="post">

                      <div class="col--4 wow fadeInUp" data-wow-offset="0" data-wow-delay="0.4s">
                        <h2>Contact US</h2>
                        <ul>
                            <li><i class="fa fa-home fa-2x"></i> Office #,17 Bulla street , Manchester Mandeville, Jamaica </li>
                            <hr>
                            <li><i class="fa fa-phone fa-2x"></i> 1(876)776-6711</li>
                            <hr>
                            <li><i class="fa fa-envelope fa-2x"></i> health_jam@gmail.com</li>
                        </ul>
                    </div>

                    <fieldset>
                        <input placeholder="Your name" type="text" name="name" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Email address:" type="email" id="email_addr" name="email" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Repeat email address:" type="email" id="email_addr_repeat" name="email_repeat" required>
                    </fieldset>
                    <fieldset>
                        <textarea placeholder="Type your Message Here...." type="submit" id="message-submit" name="message"></textarea>
                    </fieldset>
                    <fieldset>
                        <button name="submit_contact_us" type="submit" id="contact-submit" data-submit="...Sending" value="submit">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>                                 
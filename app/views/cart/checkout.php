<div class="bg">
    <div class="container">
        <!-- echo out the system feedback (error and success messages) -->
        <?php View::renderFeedbackMessages(); ?>

        <div class="row">
            <h1>Checkout</h1>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <div class="box checkout-form">
                    <h2>Payment Details</h2>
                    <form action="<?php echo URL . '/cart/done'; ?>" method="post" class="form clearfix newform">
                        <?php if ($this->cards) : ?>
                        <div class="form-group">
                            <ul>
                                <li>
                                <?php foreach ($this->cards as $card) : ?>
                                    <li>
                                        <label class="col-sm-3 control-label" for="credit-card-<?= $card->id ?>">Card ending with <?php echo substr($card->card_number, -4); ?></label>
                                        <input class="credit-card-file" type="radio" name="credit_card" id="credit-card-<?= $card->id ?>" value="<?= $card->id ?>">
                                    </li>
                                <?php endforeach; ?>
                                <label class="col-sm-3 control-label" for="credit-card-new">New Card</label>
                                <input type="radio" name="credit_card" id="credit-card-new" value="" checked></li>
                            </ul>
                        </div>
                        <hr>
                        <?php endif; ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card_holder_name">Name on Card</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="card_holder_name" id="card_holder_name" placeholder="Card Holder's Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="card_number">Card Number</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" name="card_number" id="card_number" placeholder="Debit/Credit Card Number" required>
                            </div>
                            <label class="col-sm-3 control-label" for="card_type">Card Type</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="card_type" required>
                                    <option value="" selected>Select Card</option>
                                    <option value="Master Card">Master Card</option>
                                    <option value="Visa">Visa</option>
                                    <option value="Discover">Discover</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="expiry_month">Expiration Date</label>
                            <div class="col-sm-9">
                              <div class="row">
                                <div class="col-xs-3 col-sm-3">
                                    <label for="expiry_month">Month</label>
                                    <select class="form-control" name="expiry_month" id="expiry-month" required>
                                        <option value="">Month</option>
                                        <option value="01">Jan (01)</option>
                                        <option value="02">Feb (02)</option>
                                        <option value="03">Mar (03)</option>
                                        <option value="04">Apr (04)</option>
                                        <option value="05">May (05)</option>
                                        <option value="06">June (06)</option>
                                        <option value="07">July (07)</option>
                                        <option value="08">Aug (08)</option>
                                        <option value="09">Sep (09)</option>
                                        <option value="10">Oct (10)</option>
                                        <option value="11">Nov (11)</option>
                                        <option value="12">Dec (12)</option>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <label for="expiry_year">Year</label>
                                    <select class="form-control" name="expiry_year" required>
                                        <option value="">Year</option>
                                        <option value="16">2016</option>
                                        <option value="17">2017</option>
                                        <option value="18">2018</option>
                                        <option value="19">2019</option>
                                        <option value="20">2020</option>
                                        <option value="21">2021</option>
                                        <option value="22">2022</option>
                                        <option value="23">2023</option>
                                        <option value="24">2024</option>
                                        <option value="25">2025</option>
                                        <option value="26">2026</option>
                                        <option value="27">2027</option>
                                        <option value="28">2028</option>
                                        <option value="29">2029</option>
                                        <option value="30">2030</option>
                                    </select>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
                            <div class="col-sm-3">
                              <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                              <input type="submit" value="Complete Purchase" class="btn btn-orange" name="submit_complete_purchase">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box">
                    <h2>Your Order</h2>
                    <ul>
                        <?php
                        $total = 0;
                         foreach ($this->shopping_cart as $cart) : 
                            $subtotal = (float)$cart->cost * (int)$cart->quantity;
                            $total += $subtotal;
                            ?>
                            <li><img class="prod-img" src="<?= $cart->prod_image_path ?>" alt="">
                                <?php echo $cart->product_name . ' $' . $subtotal; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <hr>
                    <p>Total: $<?= $total ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg">
    <div class="container">
        <div class="profile-text">  
              <h3>SHOP</h3>
            <form  method="POST" action="<?php echo URL . 'shop'; ?>" accept-charset="UTF-8" style="display: inline-block;">
                <input class="Search" name="q" placeholder="Search" value="<?= !empty($this->q) ? $this->q : '' ?>" type="text">
                <input class="Searchbtn" value="Search" type="submit" name="submit_search_shop">
            </form>
        </div>
<div class="row">
                <?php foreach ($this->products as $product) : ?>
                   
                    <div class="f1">
                        <div class="media-v1">
                            <img class="shop-img" src="<?= !empty($product->prod_image_path) ? $product->prod_image_path : URL . '/img/no-image.jpeg' ?>" alt="">
                        </div>
                        
                        <div class="shop-panel">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <h4><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p class="uk-text-small">
                                <span class="itemDescription">
                                        Brand: <?php echo htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8'); ?> <br>
                                        Category: <?php echo htmlspecialchars($product->category, ENT_QUOTES, 'UTF-8'); ?><br>
                                        Provided by <a href="<?= URL . '/shop/seller/' . $product->seller_id ?>"><?php echo htmlspecialchars($product->username, ENT_QUOTES, 'UTF-8'); ?></a> <br>
                                    </span><br>
                            Price: $<span ref="iphoneX" class="uk-text-lead itemPrice"> <?php echo htmlspecialchars($product->cost, ENT_QUOTES, 'UTF-8'); ?></span> JMD <br><br>
                            <span class="uk-padding uk-text-center">
                                            <form  method="POST" action="<?php echo URL . '/cart/add/' . htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>" style="display: inline-block;">
                                                <input type="hidden" name="cost" value="<?php echo htmlspecialchars($product->cost, ENT_QUOTES, 'UTF-8'); ?>">
                                                <select name="quantity" id="quantity">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                </select>
                                                <input value="Add to Cart" type="submit" name="submit_add_cart" class="btn btn-orange">
                                            </form>
                                    </span>
                            </p>
                        </div>
                    
                </div>
             
                <?php endforeach; ?>
              
   </div>
    </div>
</div>
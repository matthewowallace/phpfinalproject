<div class="bg">
    <div class="container">
        <div class="uk-grid">
            <div class="uk-width-1-1">
                <div class="uk-child-width-1-1@s uk-child-width-1-5@m uk-padding uk-grid">
                <?php foreach ($this->products as $product) : ?>
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-media-top uk-text-center"><br>
                            <img class="imageSizing" src="<?= !empty($product->prod_image_path) ?  URL . '/img/' . $product->prod_image_path : URL . '/img/no-image.jpeg' ?>" alt="">
                        </div>
                        <div class="uk-card-body">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($product->id, ENT_QUOTES, 'UTF-8'); ?>">
                            <h4><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p class="uk-text-small">
                                <span class="itemDescription">
                                            Brand: <?php echo htmlspecialchars($product->brand, ENT_QUOTES, 'UTF-8'); ?> <br>
                                            Category: <?php echo htmlspecialchars($product->category, ENT_QUOTES, 'UTF-8'); ?><br>
                                            Provided by <a href="#"><?php echo htmlspecialchars($product->username, ENT_QUOTES, 'UTF-8'); ?></a> <br>
                                        </span><br>
                                Price: $<span ref="iphoneX" class="uk-text-lead itemPrice"> <?php echo htmlspecialchars($product->cost, ENT_QUOTES, 'UTF-8'); ?></span> USD <br><br>
                                <span class="uk-padding uk-text-center">

                                            <button ref="iphoneX_01" class="uk-button uk-button-primary uk-button-small itemSelect">Select</button>
                                        </span>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
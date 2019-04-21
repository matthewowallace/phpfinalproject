<div class="bg">
    <div class="container">
        <div class="profile-text">  
              <h3>PARTNERS</h3>
            <form  method="POST" action="<?php echo URL . 'partners/list'; ?>" accept-charset="UTF-8" style="display: inline-block;">
                <input class="Search" name="q" placeholder="Search" value="<?= !empty($this->q) ? $this->q : '' ?>" type="text">
                <input class="Searchbtn" value="Search" type="submit" name="submit_search_partner">
            </form>
        </div>
<div class="row">
                <?php foreach ($this->partners as $partner) : ?>
                   
                    <div class="f1">
                        <div class="media-v1">
                            <img class="shop-img" src="<?= !empty($partner->image_path) ? $partner->image_path : URL . '/img/no-image.jpeg' ?>" alt="">
                        </div>
                        
                        <div class="shop-panel">
                            <h4><?php echo htmlspecialchars($partner->name, ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p class="uk-text-small">
                                <span class="itemDescription">
                                        Address: <?php echo htmlspecialchars($partner->address, ENT_QUOTES, 'UTF-8'); ?> <br>
                                        Contact: <?php echo htmlspecialchars($partner->contact, ENT_QUOTES, 'UTF-8'); ?><br>
                                        Email: <?php echo htmlspecialchars($partner->email, ENT_QUOTES, 'UTF-8'); ?><br>
                                    </span>
                            </p>
                        </div>
                    
                </div>
             
                <?php endforeach; ?>
              
   </div>
    </div>
</div>
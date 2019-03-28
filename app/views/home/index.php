


<!-- Hero Area -->
<section class="Hero_area">
  <div class="container">
    <div class="row-fluid">
   <a href="#feature"><h1 class="animated pulse">CLICK TO GET FIT</h1></a>
    </div>
<div class="container">    
<div class="row">
  <div id="carousel">
  <div class="btn-bar">
    <div id="buttons"><a id="prev" href="#"><i class="fa fa-angle-double-left"></i></a><a id="next" href="#"><i class="fa fa-angle-double-right"></i></a> </div></div>
    <div id="slides">
        <ul>
            <li class="slide">
                <div class="quoteContainer">
                    <p class="quote-phrase"><span class="quote-marks">"</span>• Eat good live good exercise right<class="quote-marks">"</span>

                    </p>
                </div>
            </li>
            <li class="slide">
                <div class="quoteContainer">
                    <p class="quote-phrase"><span class="quote-marks">"</span>
                     Be an inspiration; join the gym nation
                    <span class="quote-marks">"</span>

                    </p>
                </div>
            </li>
            <li class="slide">
                <div class="quoteContainer">
                    <p class="quote-phrase"><span class="quote-marks">"</span>If you want to get slim; join the gym<span class="quote-marks">"</span>

                    </p>
                </div>
            </li>
            <li class="slide">
                <div class="quoteContainer">
                    <p class="quote-phrase"><span class="quote-marks">"</span>  Let FitSeeker be your guide in the pursuit of Good Health<span class="quote-marks">"</span>

                    </p>
                </div>
            </li>
            <li class="slide">
                <div class="quoteContainer">
                    <p class="quote-phrase"><span class="quote-marks">"</span> Maintain that body you live in.<span class="quote-marks">"</span>

                    </p>
                </div>
            </li>
        </ul>
    </div>
</div>
</div>

<div class="container">
    <div class="row">
    <div id="sign_up" class="col">
    <a  href="<?= URL ?>/user/login"><button type="button" class="btn btn-dark">Sign in</button></a>
    <a href="<?= URL ?>/user/register"><button type="button" class="btn btn-orange">Register</button></a>
    </div>
  </div>
 </div>
 </div>
</section>
  <!-- end of Hero -->
  <!-- Mission statement -->
<section class="about_us">
 <div class="container">
  <div class="row">
    <div class="col-mid-6">
      <h3>Our mission</h3>
        <p>To be the guide of individuals who are seeking the betterment of their social and physical lifestyle by offering them a window to what the various Jamaican fitness and sport organization has to offer to suit their needs.
        </p>                   
    </div>
  </div>
</div>
</section>
<!-- End of mission statement -->
 <svg id="icons" xmlns="http://www.w3.org/2000/svg">  
<symbol id="icon-arrow" viewBox="0 0 476.213 476.213" >
<polygon fill="inherit" points="347.5,324.393 253.353,418.541 253.353,0 223.353,0 223.353,419.033 128.713,324.393 107.5,345.607 
  238.107,476.213 368.713,345.606 "/>
</symbol>
</svg>

<!-- Text Banner -->
<section class="About-Fitness">
  <div class="fit">
  <div class=row>
    <div class="col-sm-6">
    <div class="fitness-left">
    <h3>Its All about Fitness</h3>
     <img class="fitness-img" src="<?= URL ?>/img/live/2.png">
      <img class="fitness-img-2" src="<?= URL ?>/img/live/3.png">
      </div>
      </div>
    <div class="col-sm-6">
    <div class="fitness-right">
       <h3>Weight Lifting</h3>
        <p>The pain you feel today is the strength you’ll feel tomorrow.Join our many key partner gyms to meet your personal fitness goal
        </p>
       <h3>Running</h3>
        <p>“It's very hard in the beginning to understand that the whole idea is not to beat the other runners. Eventually you learn that the competition is against the little voice inside you that wants you to quit.”     
        — George Sheehan
        </p>
         <h3>Yoga</h3>
        <p>Training gives us an outlet for suppressed energies created by stress and thus tones the spirit just as exercise conditions the body.  ~ Arnold Schwarzenegger
        </p>
      </div>
    </div>
  </div>
  <div>
</section>
  
  <!-- end of Text banner -->
<!-- AboutUs statement -->
<section class="about_us_cont-top">
      <div class="container">
        <div class="row"> 
        
        <div class="col-sm-12"> 
        <h3>About Us</h3>
        <p>
          “HealthJam” are pioneers in the business of locating health and fitness offerings and products from across Jamaica, and making them available to existing and potential market segments across the nation. Driven by a strong service philosophy, assert that a healthy lifestyle can be adopted by everyone who is desirous, at affordable costs. We further believe that fitness and health providers should be presented with a suitably sophisticated platform from which they can showcase their products and services to the public at large, especially to the health and fitness market.
        </p>
        <a href="Aboutus.php"><button type="button" class="btn btn-orange">Read More</button></a>
      </div>
        </div>    
        </div> 
      </div>
    </section>


<section>
  <div class="container-fluid">
    <div id="fitslider">
  <div id="images">
    <?php foreach ($this->ads as $ad) : ?>
      <?php if ($ad->ad_type == 'Image') : ?>
        <img  src="<?= $ad->file_path?>" alt="">
      <?php else: ?>
        <video src="<?= $ad->file_path?>" controls></video>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>
</div>
</section>
    <div id="feature">
            <div class="cover">
               <div>
                        <div class="text-center">
                            <h1>Features</h1>
                        </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col wow fadeInRight" data-wow-offset="0" data-wow-delay="0.3s">
                            <li>
                                <a href="<?= URL ?>/inventory" title="Inventory Manager">
                                    <div class="text-center">
                                        <div class="hi-icon-wrap hi-icon-effect">
                                      
                                                  <img src="<?= URL ?>/img/inventorymanager.png">  
                                                    <a href="<?= URL ?>/inventory"><button type="button" class="btn btn-orange">View More</button></a>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </div>
                        <div class="col wow fadeInLeft" data-wow-offset="0" data-wow-delay="0.3s">
                            <li>
                                <a href="#fitslider" title="Fitness Bar (Notice Board)">
                                    <div class="text-center">
                                        <div class="hi-icon-wrap hi-icon-effect">
                                           
                                                    <img src="<?= URL ?>/img/fitnessbar.png">  
                                                      <a href="#fitslider"><button type="button" class="btn btn-orange">View More</button></a>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </div>
                        <div class="col wow fadeInLeft" data-wow-offset="0" data-wow-delay="0.3s">
                            <li>
                                <a href="<?= URL ?>/shop" title="Online Shopping">

                                    <div class="text-center">
                                        <div class="hi-icon-wrap hi-icon-effect">
                                          
                                                <img src="<?= URL ?>/img/onlineshopping.png">  
                                                  <a href="<?= URL ?>/shop"><button type="button" class="btn btn-orange">View More</button></a>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      <?php
      // include('contact.php');
      ?>

    <div class='scrolltop'>
        <div><h4>Stay Connected</h4></div>
    <div class='scroll icon'><i class="fa fa-4x fa-angle-up"></i></div>
</div>
</main>


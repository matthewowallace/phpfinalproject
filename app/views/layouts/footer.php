 <footer class="page-footer font-small black pt-4">
       <!-- Footer Links -->
    <div class="l"><img class="logos" src="<?php echo URL; ?>/img/logo.png" alt="logos"></div>
   <p>Nothing comes easy, but as long as you’re breathing, you’re always one breath away from making your dreams a reality. Make every breath count.
   <br>
   Kai Greene</p>
   <div class="Support"><a>Privacy Policy</a><a href="<?= URL ?>/terms">Terms Of Use</a><a>Support</a></div>
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© HealthJam,INC.2019 Copyright:
      <a href="https://mdbootstrap.com/education/bootstrap/"> All Rights Reserved. All trademarks referenced herein are the properties of their respective owners.</a>
    </div>
    <!-- Copyright -->
  
 </footer>

 
 
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="<?php echo URL; ?>/js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="<?php echo URL; ?>/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="<?php echo URL; ?>/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="<?php echo URL; ?>/js/mdb.min.js"></script>
  <script type="text/javascript" src="<?php echo URL; ?>/js/Navbar.js"></script>
  <script type="text/javascript" src="<?php echo URL; ?>/js/script.js"></script>

  <script type="text/javascript" src="<?php echo URL; ?>/js/responsiveCarousel.min.js"></script>

  <script type="text/javascript">
$(function(){
  $('.crsl-items').carousel({
    visible: 3,
    itemMinWidth: 180,
    itemEqualHeight: 370,
    itemMargin: 9,
  });
  
  $("a[href=#]").on('click', function(e) {
    e.preventDefault();
  });
});
</script>
<script type="text/javascript">
  $(document).ready(function () {
    //rotation speed and timer
    var speed = 5000;
    
    var run = setInterval(rotate, speed);
    var slides = $('.slide');
    var container = $('#slides ul');
    var elm = container.find(':first-child').prop("tagName");
    var item_width = container.width();
    var previous = 'prev'; //id of previous button
    var next = 'next'; //id of next button
    slides.width(item_width); //set the slides to the correct pixel width
    container.parent().width(item_width);
    container.width(slides.length * item_width); //set the slides container to the correct total width
    container.find(elm + ':first').before(container.find(elm + ':last'));
    resetSlides();
    
    
    //if user clicked on prev button
    
    $('#buttons a').click(function (e) {
        //slide the item
        
        if (container.is(':animated')) {
            return false;
        }
        if (e.target.id == previous) {
            container.stop().animate({
                'left': 0
            }, 1500, function () {
                container.find(elm + ':first').before(container.find(elm + ':last'));
                resetSlides();
            });
        }
        
        if (e.target.id == next) {
            container.stop().animate({
                'left': item_width * -2
            }, 1500, function () {
                container.find(elm + ':last').after(container.find(elm + ':first'));
                resetSlides();
            });
        }
        
        //cancel the link behavior            
        return false;
        
    });
    
    //if mouse hover, pause the auto rotation, otherwise rotate it    
    container.parent().mouseenter(function () {
        clearInterval(run);
    }).mouseleave(function () {
        run = setInterval(rotate, speed);
    });
    
    
    function resetSlides() {
        //and adjust the container so current is in the frame
        container.css({
            'left': -1 * item_width
        });
    }
    
});
//a simple function to click next link
//a timer will call this function, and the rotation will begin

function rotate() {
    $('#next').click();
}
</script>
<script type="text/javascript">
  $(window).scroll(function() {
    if ($(this).scrollTop() > 50 ) {
        $('.scrolltop:hidden').stop(true, true).fadeIn();
    } else {
        $('.scrolltop').stop(true, true).fadeOut();
    }
});
$(function(){$(".scroll").click(function(){$("html,body").animate({scrollTop:$(".navigation").offset().top},"1000");return false})})
</script>
</body>
</html>
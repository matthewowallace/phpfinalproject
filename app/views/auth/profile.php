
    <div class="tab">
        <a class="tablinks active" href="<?= URL ?>/user/profile">Dashboard</button></a>
        <a class="tablinks" href="<?= URL ?>/inventory">Inventory</button></a>
        <!-- <button class="tablinks" onclick="openCity(event, 'Subscription')">Add Subscription</button> -->
    </div>

    <div id="New-Item" class="tabcontent" style="display: block;">
            <div class="container">
                <div class="row">
                <div class="f5">
                <div class="inventory-title"><h3>DASHBOARD</h3></div>
                </div>
                    <div class="f3">
                        <div class="profile-text"> <h3>Profile Info</h3></div>
                        <div class="media-v1">
                            <img src="<?= URL ?>/img/default-user.png">
                        </div>

                        <hr>
                     
                        <div class="profile-text">
                           
                            <h4>Username: <?= $this->user->username ?></h4>
                            <h4>User Type: <?= $this->user->is_contributer ? 'Contributer' : 'Subscriber' ?></h4>
                            <h4>Current server time: <?php $timestamp = time();  echo "\n"; echo(date("F d, Y h:i:s A", $timestamp)); ?></h4>
                        </div>
                               <a><button id="myBtn" type="button" class="btn btn-black">Edit Profolio</button></a>
                    </div>



                              <!-- The Modal -->
                        <div id="myModal" class="modal">
                          <!-- Modal content -->
                          <div class="modal-content">
                            <span class="close">&times;</span>
                             <div class="container">
                                <div class="row">
                                   <div class="f3">
                                       <div class="media-v2">
                                            <img src="<?= URL ?>/img/default-user.png">
                                      </div>
                                       <a><button id="myBtn" type="button" class="btn btn-black">Change Profile picture</button></a>
                                  </div>

                                <div class="f2">
                                    <div class="user-info"><label>Username:  <?= $this->user->username ?></label></div><br>
                                     <div class="user-info"><label>Phone:  <?= $this->user->username ?></label></div><br>
                                     <div class="user-info"><label>Email:  <?= $this->user->username ?></label></div><br>
                                     <div class="user-info"><label>Company:  <?= $this->user->username ?></label></div><br>
                                    <div class="user-info"><label>Country:  <?= $this->user->username ?></label></div><br>
                                    <a><button id="myBtn" type="button" class="btn btn-orange">Edit Info</button></a>

                                <hr>
                                    <div class="user-info"><label>UserSince:  <?= $this->user->username ?></label></div><br>
                                    <div class="user-info"><label>Last Log in:  <?= $this->user->username ?></label></div><br>
                                    <div class="user-info"><label>Subscription Expiration Date:  <?= $this->user->username ?></label></div>
                                </div>
                            </div>
                          </div>
                        </div>                   
                        </div>



                              <!-- The Modal -->
                        <div id="Subscription" class="odal">
                          <!-- Modal content -->
                          <div class="odal-content">
                            <span class="close-1">&times;</span>
                             <div class="container">
                                <div class="row">
                                <div class="subscription-panel">
                                    <h4>1-MONTH PLAN</h4>
                                    <h3><span class="dollar">$</span>15<span class="per-month">/mo</span></h3>
                                     <ul class="features">
                                        <li>1 Domain</li>
                                        <li>10 GB Disk Space</li>
                                        <li>50 GB Bandwidth</li>
                                        <li>Free Domain</li>
                                    </ul>
                                    <a><button id="myBtn" type="button" class="btn btn-orange">GO PREMIUM</button></a>
                                    <h5>$15.00 charged every month</h5>
                                </div>
                                 <div class="subscription-panel">
                                   <h4>3-MONTH PLAN</h4>
                                    <h3><span class="dollar">$</span>49.99<span class="per-month">/mo</span></h3>
                                     <ul class="features">
                                        <li>1 Domain</li>
                                        <li>10 GB Disk Space</li>
                                        <li>50 GB Bandwidth</li>
                                        <li>Free Domain</li>
                                    </ul>
                                    <a><button id="myBtn" type="button" class="btn btn-orange">GO PREMIUM</button></a>
                                    <h5>$29.99 charged every month</h5>
                                </div>
                                 <div class="subscription-panel">
                                  <h4>12-MONTH PLAN</h4>
                                    <h3><span class="dollar">$</span>175<span class="per-month">/mo</span></h3>
                                     <ul class="features">
                                        <li>1 Domain</li>
                                        <li>10 GB Disk Space</li>
                                        <li>50 GB Bandwidth</li>
                                        <li>Free Domain</li>
                                    </ul>
                                    <a><button id="myBtn" type="button" class="btn btn-orange">GO PREMIUM</button></a>
                                    <h5>$59.99 charged every month</h5>
                                </div>
                            </div>
                          </div>
                        </div>                   
                        </div>


                
                    <div class="f2">
                        <div class="media-v1">
                            <iframe width="100%" height="400px" src="https://www.youtube.com/embed/_iahdbRc_aA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="media-text">
                            <p>“It's very hard in the beginning to understand that the whole idea is not to beat the other runners. Eventually you learn that the competition is against the little voice inside you that wants you to quit.”     
                            — George Sheehan
                        </p>
                        </div>
                    </div>

           

                    <div class="f4">
                        <div class="sub-text">
                            <h3>Subscription</h3>
                        </div>
                        <div class="media-text">
                            <p> Here you manage Your Subscription
                        </p>
                        </div>
                        <a><button id="subBtn" type="button" class="btn btn-orange">Add/Manage</button></a>
                        <a href="<?= URL ?>/user/upgrade" id="subBtn" type="button" class="btn btn-orange">Upgrade to Contributer</a>
                    </div>
                </div>
            </div>
        </div>



<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

<script>
// Get the modal
var odal = document.getElementById('Subscription');

// Get the button that opens the moda
var btn = document.getElementById("subBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close-1")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  odal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  odal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == odal) {
    odal.style.display = "none";
  }
}
</script>
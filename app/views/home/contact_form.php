<?php
// define variables and set to empth values
$name_error = $email_error = $phone_error = $url_error = "";
$fname =$lname = $email = $phone = $message = $url =" ";

//form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty($_POST["fname"])){
        $name_error = "First name is Required";
    }else{
        $fname = test_input($_POST["fname"]);
        //check if name only contains letters and whitespace
        if(!preg_match("/^[a-zA-Z]*$/",$fname)) {
            $name_error = "Only letters and white space allowed";
        }
    }
    
    if(empty($_POST["lname"])){
        $name_error = "Last name is Required";
    }else{
        $lname = test_input($_POST["lname"]);
        //check if name only contains letters and whitespace
        if(!preg_match("/^[a-zA-Z]*$/",$lname)) {
            $name_error = "Only letters and white space allowed";
        }
    }

    if (empty($_POST[email])) {
        $email_error = "Email is required";
    }else{
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $email_error = "Invalid email format";
            }
        }
    
    if(empty($_POST["phone"])) {
        $phone_error="Phone is required";
     }else{
            $phone = test_input($_POST["phone"]);
            //check if email address is well-formed
            if(!preg_match("/^(d{\s-]?)?[\(\[\s-]{0,2}?\d{3}[\)\]\s-]{0,2}?\d{3}[\s-]?\d{4}$/i",$phone)){
                $phone_error = "Invalid phone number";
            }
    
    }
     
    if (empty($_POST["url"])) {
      $url_error = "";
    } else {
            $url = test_input($_POST["url"]);
            // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
            if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
            $url_error = "Invalid URL";
            }
    }
    if (empty($_POST["message"])) {
        $message = "";
    } else {
        $message = test_input($_POST["message"]);
    }
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

  <div id="contact">
                    <div class="cover-1">
                        <div class="container">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 wow fadeInUp" data-wow-offset="0" data-wow-delay="0.6s">
                                    <div id="sendmessage">Your message has been sent. Thank you!</div>
                                    <div id="errormessage"></div>
                                    <form action="MAILTO:matthewowallace@gmail.com" id="quick-contact" method="post" enctype="text/plain">
                                        
                                          <div class="col--4 wow fadeInUp" data-wow-offset="0" data-wow-delay="0.4s">
                                    <h2>Contact US</h2>
                                    <ul>
                                        <li><i class="fa fa-home fa-2x"></i> Office #,17 Bulla street , Manchester Mandeville, Jamaica </li>
                                        <hr>
                                        <li><i class="fa fa-phone fa-2x"></i> 1(876)776-6711</li>
                                        <hr>
                                        <li><i class="fa fa-envelope fa-2x"></i> Health_Jam@gmail.com</li>
                                    </ul>
                                </div>

                                        <fieldset>
                                            <input placeholder="Your name" type="text" tabindex="1" required autofocus>
                                        </fieldset>
                                        <fieldset>
                                            <input placeholder="Email address:" type="email" id="email_addr" name="email_addr" required>
                                        </fieldset>
                                        <fieldset>
                                            <input placeholder="Repeat email address:" type="email" id="email_addr_repeat" name="email_addr_repeat" required oninput="check(this)">
                                        </fieldset>
                                        <fieldset>
                                            <textarea placeholder="Type your Message Here...." tabindex="5" type="submit" id="message-submit"></textarea>
                                        </fieldset>
                                        <fieldset>
                                            <button name="submit" type="submit" id="contact-submit" data-submit="...Sending" value="submit">Submit</button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                                 
<?php

/**
 * The default home controller, called when no controller/method has been passed
 * to the application.
 */
class ContactController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        $this->view->render('home/contact');
    }

    public function store()
    {
        // if we have POST data to create a new user.
        if (isset($_POST['submit_contact_us'])) {

            $is_dirty = false;

            // Sanitize and validate information.
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $email_repeat = filter_var($_POST['email_repeat'], FILTER_SANITIZE_EMAIL);
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {                
                Session::add('feedback_negative', 'Invalid email entered');
                $is_dirty = true;
            }

            if (filter_var($email_repeat, FILTER_VALIDATE_EMAIL) === false) {                
                Session::add('feedback_negative', 'Invalid email entered');
                $is_dirty = true;
            }

            if (strcmp($email, $email_repeat) !== 0) {
                Session::add('feedback_negative', 'Email address does not match');
                $is_dirty = true;
            }

            $successful = false;

            if (!$is_dirty) {
                $Contact = $this->model('Contact');
                $successful = $Contact->addContact($name, $email, $message);

                if ($successful) {
                    Session::add('feedback_positive', 'Your message has been sent. Thank you!');
                }
            }            

            Redirect::to('contact');
        }
    }
}

<?php

/**
 * The default home controller, called when no controller/method has been passed
 * to the application.
 */
class UserController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        $user = $this->model('user');

        $this->view->render('home/index');
    }

    /**
     * Register method.
     *
     * @return void
     */
    public function register()
    {
        $this->view->render('auth/register');
    }

    /**
     * ACTION POST: Create a new object and stores to the database.
     *
     * @return void
     */
    public function store() {
        
        // if we have POST data to create a new user.
        if (isset($_POST['submit_register_user'])) {

            $is_dirty = false;

            // Sanitize and validate information.
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if ($password !== $cpassword) {
                Session::add('feedback_negative', 'Passwords does not match');
                $is_dirty = true;
            }

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {                
                Session::add('feedback_negative', 'Invalid email entered');
                $is_dirty = true;
            }

            $successful = false;

            if (!$is_dirty) {
                $User = $this->model('User');
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
                $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);            
                // $is_subscriber = filter_var($_POST['is_subscriber'], FILTER_SANITIZE_STRING);

                // Save user if error return false
                $sucessful = $User->addUser($username, $first_name, $last_name, $email, $password_hash);
            }            

            if ($sucessful) {
                Redirect::to('user/login');
            } else {
                Redirect::to('user/register');
            }
        }
    }

    /**
     * Login method.
     *
     * @return void
     */
    public function login()
    {
        // If user is logged in redirect to welcome.
        if (Session::userIsLoggedIn()) {
            Redirect::to('home/index');
            exit();
        }

        $this->view->render('auth/login');
    }

    /**
     * Login method.
     *
     * @return void
     */
    public function authenticate()
    {
        // if we have POST data to create a new user entry
        if (isset($_POST['submit_login_user'])) {
            $User = $this->model('User');

            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            
            $login_successful = $User->login($email, $password);
            
            // check login status: if true, then redirect user to user/index, if false, then to login form again
            if ($login_successful) {
                Session::add('feedback_positive', 'Welcome back, ' . Session::get('username'));
                // TODO: Change to view with dashboard after login.
                Redirect::to('home/index');
                exit();
            } else {
                Redirect::to('user/login'); // Redirect to login.
                exit();
            }
        }
        
        // Redirect to signin if method is accessed directly
        Redirect::to('user/login');
        exit();
    }

    /**
     * Get account information.
     *
     * @return void
     */
    public function profile()
    {
        $User = $this->model('user');
        $user = $User->getUserbyEmail(Session::get('email')); // getting all users

        // load views. within the views we can echo out $products easily
        $this->view->render('auth/profile', [
            'user' => $user
        ]);
    }

    /**
     * ACTION: Show the form for editing the specified resource.
     * @param int $id Id of product
     */
    public function edit($id)
    {
        if (isset($id)) {
            $User = $this->model('user');

            $user = $User->getUserbyEmail(Session::get('email'));

            $this->view->render('auth/edit', array('user' => $user));
        } else {
            // redirect user to requests index page (as we don't have a request_id)
            Redirect::to('user/profile');
        }
    }

    /**
     * ACTION: Update the specified resource in storage.
     */
    public function update($id)
    {
        $is_dirty = false;
        $password_hash = null;
        if (!empty($_POST['password']) && !empty($_POST['cpassword'])) {         
            // Sanitize and validate information.
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if ($password !== $cpassword) {
                Session::add('feedback_negative', 'Passwords does not match');
                $is_dirty = true;
            }
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {                
            Session::add('feedback_negative', 'Invalid email entered');
            $is_dirty = true;
        }

        $successful = false;

        if (!$is_dirty) {
            $User = $this->model('User');
            $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
            $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
            $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);            
            // $is_subscriber = filter_var($_POST['is_subscriber'], FILTER_SANITIZE_STRING);

            // Save user if error return false
            $sucessful = $User->updateUser($id, $username, $first_name, $last_name, $email, $password_hash);
        }            

        Redirect::to('user/profile');
    }

    /**
     * Show agreement form to upgrade account.
     * 
     * @return
     */
    public function upgrade()
    {
        $this->view->render('auth/upgrade');
    }

    /**
     * Update account to contributer.
     * @return [type] [description]
     */
    public function agree() 
    {
        // if we have POST data to create a new user entry
        if (isset($_POST['submit_upgrade_user'])) {
            $User = $this->model('User');
            $agree = filter_var($_POST['agree'], FILTER_SANITIZE_STRING);
            
            if ($agree) {
                $successful = $User->upgradeAccount(Session::get('id'), $agree);
                     
                // check login status: if true, then redirect user to user/index, if false, then to login form again
                if ($successful) {
                    Session::add('feedback_positive', 'Account upgraded');
                    // TODO: Change to view with dashboard after upgrade.
                    Redirect::to('user/profile');
                    exit();
                } else {
                    Redirect::to('user/upgrade'); // Redirect to upgrade.
                    exit();
                }
            } else {
                Redirect::to('user/upgrade'); // Redirect to upgrade.
                exit();
            }
            
            
        }
        
        // Redirect to profile
        Redirect::to('user/profile');
        exit();
    }

    /**
     * The logout action
     * Perform logout, redirect user to main-page
     */
    public function logout()
    {
        // Instance new Model (Login)
        $User = $this->model('User');
        $User->logout();

        Redirect::home();
        exit();
    }
}

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
        
        $this->view->render('home/index', [
            'show_bar' => $this->show_bar(),
        ]);
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
                $is_subscriber = 1; // filter_var($_POST['is_subscriber'], FILTER_SANITIZE_STRING);

                // Save user if error return false. Set contributer to 1
                $sucessful = $User->addUser($username, $first_name, $last_name, $email, $password_hash, $is_subscriber);
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
        $Order = $this->model('order');
        $orders = $Order->getAllOrders(SESSION::get('id'), true); // Limit to one
        $myorders = array();

        foreach ($orders as $order) {
            $myorders[$order->order_date][] = $order;
        }

        // load views. within the views we can echo out $products easily
        $this->view->render('auth/profile', [
            'user' => $user,
            'orders' => $myorders,
            'show_bar' => $this->show_bar(),
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
     * @method get
     * @return
     */
    public function upgrade()
    {
        $this->view->render('auth/upgrade');
    }

    /**
     * Update account to contributer.
     * @method post
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
     * Change the profile image
     *
     * @method get
     */
    public function image()
    {
       $this->view->render('auth/change_profile'); 
    }

    /**
     * Save profile image
     * @method post
     */
    public function change()
    {
        if (isset($_POST["submit_change_profile"])) {
            
            $user_id = Session::get('id');
            $image_path = '';

            if (isset($_FILES['image'])){
                $errors= array();
                $file_name = $_FILES['image']['name'];
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                
                $extensions= array("jpeg","jpg","png");
                
                if (in_array($file_ext, $extensions) === false){
                    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }
                
                // if ($file_size > 2097152){
                //     $errors[]='File size must be less then than 2 MB';
                // }
                
                if (empty($errors) == true) {
                    $image_path = URL . '/uploads/' . $file_name;
                    if (move_uploaded_file($file_tmp, ASSET_ROOT . '/uploads/' . $file_name)) {
                        echo "File is valid, and was successfully uploaded.\n";
                    } else {
                        Session::add('feedback_negative', 'Upload failed');
                    }
                }else{
                    Session::add('feedback_negative', $errors);
                }
            }

            $User = $this->model('user');
            $product = $User->updateProfile($user_id, $image_path);

            // TODO: Create error page for displaying messages and use sessions for showing messages.
            if (!$product) {
                Session::add('feedback_negative', 'Error saving user profile');
            }
        }

        // where to go after vehicle_request has been added
        Redirect::to('user/profile');
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

    public function show_bar() {
        if (Session::userIsLoggedIn() && $this->is_contributer(Session::get('id'))) {
            return true;
        }
        return false;
    }
}

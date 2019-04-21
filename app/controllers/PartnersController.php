<?php

/**
 * The partner controller, called when no controller/method has been passed
 * to the application.
 */
class PartnersController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        $Partner = $this->model('partner');

        $q = ''; // Search string
        $user_id = Session::get('id');

        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_search_partner"])) {
            $q = filter_var($_POST['q'], FILTER_SANITIZE_STRING);
            
            $partners = $Partner->getPartners($user_id, $q);
        } else {
            $partners = $Partner->getAllPartners($user_id); // getting all items
        }

        // load views. within the views we can echo out $partners easily
        $this->view->render('partners/index', [
            'partners' => $partners,
            'q' => $q,
            'show_bar' => $this->show_bar(),
        ]);
    }

    public function gyms()
    {
        $Partner = $this->model('partner');

        $q = ''; // Search string
        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_search_partner"])) {
            $q = filter_var($_POST['q'], FILTER_SANITIZE_STRING);
            
            $partners = $Partner->getPartners(null, $q);
        } else {
            $partners = $Partner->getAllPartners(null); // getting all items
        }

        // load views. within the views we can echo out $partners easily
        $this->view->render('partners/gyms', [
            'partners' => $partners,
            'q' => $q,
        ]);
    }

    /**
     * ACTION: Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        // load views. within the views we can echo out $partners easily
        $this->view->render('partners/create', [
        ]); 
    }

    /**
     * Create a new admin object and stores to the database.
     *
     * @return void
     */
    public function store() {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_add_partner"])) {
            
            $user_id = Session::get('id');
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $contact = filter_var($_POST['contact'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $prod_image_path = '';

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
                    // die(ASSET_ROOT . '/img/' . $file_name);
                    $prod_image_path = URL . '/img/' . $file_name;
                    if (move_uploaded_file($file_tmp, ASSET_ROOT . '/img/' . $file_name)) {
                        echo "File is valid, and was successfully uploaded.\n";
                    } else {
                        die("Upload failed");
                    }
                }else{
                    print_r($errors);
                }
            }

            $Partner = $this->model('partner');
            $partner = $Partner->addPartner($name, $address, $user_id, $contact, $email, $prod_image_path);

            // TODO: Create error page for displaying messages and use sessions for showing messages.
            if (!$partner) {
                die('Error saving partner');
            }
        }

        // where to go after vehicle_request has been added
        Redirect::to('partners');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Partner
     */
    public function show($id) {

    }

    /**
     * ACTION: Show the form for editing the specified resource.
     * @param int $id Id of partner
     */
    public function edit($id)
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        if (isset($id)) {
            $Partner = $this->model('partner');

            $partner = $Partner->getPartner($id);

            $this->view->render('partners/edit', array('partner' => $partner));
        } else {
            // redirect user to requests index page (as we don't have a request_id)
            Redirect::to('partners/index');
        }
    }

    /**
     * ACTION: Update the specified resource in storage.
     */
    public function update($id)
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_update_partner"])) {
            $User = $this->model('user');

            // $user_id = $User->isAdmin(Session::get('id')) ? Session::get('id') : Session::get('id');
            $user_id = Session::get('id');
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $contact = filter_var($_POST['contact'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
            $prod_image_path = '';

            if (!empty($_FILES['image']['name'])) {
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
                    // die(ASSET_ROOT . '/img/' . $file_name);
                    $prod_image_path = URL . '/img/' . $file_name;
                    if (move_uploaded_file($file_tmp, ASSET_ROOT . '/img/' . $file_name)) {
                        echo "File is valid, and was successfully uploaded.\n";
                    } else {
                        die("Upload failed");
                    }
                }else{
                    print_r($errors);
                }
            }

            $Partner = $this->model('partner');
            $partner = $Partner->updatePartner($user_id, $id, $name, $address, $contact, $email, $prod_image_path);
// die($id);
            if (!$partner) {
                Session::add('feedback_negative', 'An error occured udpate partner.\n');
                Redirect::to('partners/edit/' . $id);
            }
        }

        // where to go after vehicle_request has been added
        Redirect::to('partners/index');
    }
    
    /**
     * Delete
     */
    public function delete($id)
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }
        
        if (isset($_POST["submit_delete_partner"])) {
            $Partner = $this->model('partner');
            $Partner->deletePartner($id);
        }

        // where to go after vehicle_request has been added
        Redirect::to('partners/index'); 
    }

    public function show_bar() {
        if (Session::userIsLoggedIn() && $this->is_contributer(Session::get('id'))) {
            return true;
        }
        return false;
    }
}
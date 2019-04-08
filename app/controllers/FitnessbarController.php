<?php

/**
 * The Fitnessbar controller, called when no controller/method has been passed
 * to the application.
 */
class FitnessbarController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        $Ad = $this->model('ads');

        $q = ''; // Search string
        $user_id = Session::get('id');

        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_search_ad"])) {
            $q = filter_var($_POST['q'], FILTER_SANITIZE_STRING);
            
            $ads = $Ad->getAds($user_id, $q);
        } else {
            $ads = $Ad->getAllAds($user_id); // getting all items
        }

        // load views. within the views we can echo out $ads easily
        $this->view->render('fitnessbar/index', [
            'ads' => $ads,
            'q' => $q,
            'show_bar' => $this->show_bar(),
        ]);
    }

    /**
     * ACTION: Show the form for creating a new ad.
     */
    public function create()
    {
        $Ad = $this->model('ads');

        // load views. within the views we can echo out $ads easily
        $this->view->render('fitnessbar/create'); 
    }

    /**
     * Create a new ad object and stores to the database.
     *
     * @return void
     */
    public function store() {

        // TODO:
        // Update query with  status
        // Fix media type saved in database
        // Prevent image path override when updating and no media is selected
        // Add gyms to database
        // User profile pic
        
        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_add_ad"])) {
                
            // $prod_image_path = filter_var($_POST['prod_image_path'], FILTER_SANITIZE_STRING);
            $user_id = Session::get('id');
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $url = filter_var($_POST['url'], FILTER_SANITIZE_STRING);
            $cost = (float)filter_var($_POST['cost'], FILTER_SANITIZE_STRING);
            $start_date = filter_var($_POST['start_date'], FILTER_SANITIZE_STRING);
            $end_date = filter_var($_POST['end_date'], FILTER_SANITIZE_STRING);
            $is_active = filter_var($_POST['is_active'], FILTER_SANITIZE_STRING);
            $url_path = '';
            $ad_type = '';

            if (isset($_FILES['image']['name'])) {

                $errors= array();
                $file_name = $_FILES['image']['name'];
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                
                $extensions= array("jpeg","jpg","png","mp4","flv");
                
                if (in_array($file_ext, $extensions) === false) {
                    $errors[]="extension not allowed, please choose a JPEG, PNG or MP4 file.";
                }
                
                // if ($file_size > 2097152){
                //     $errors[]='File size must be less then than 2 MB';
                // }
                
                if (in_array($file_ext, array('jpeg', 'jpg', 'png')) === true) {
                    $ad_type = 'Image';
                } elseif(in_array($file_ext, array('mp4', 'WebM', 'ogg')) === true) {
                    $ad_type = 'Video';
                }
                
                if (empty($errors) == true) {
                    $uid = uniqid();
                    $url_path = URL . '/img/' . $uid . $file_name;
                    $file_path = ASSET_ROOT . '/img/' . $uid . $file_name;

                    if (move_uploaded_file($file_tmp, $file_path)) {
                        Session::add('File was successfully uploaded.\n');
                    } else {
                        Session::add('feedback_negative', 'Upload failed. Please try again.');
                        // return;
                    }
                } else {
                    Session::add('feedback_negative', $errors);
                    // print_r($errors);
                    // return;
                }
            }

            $Ad = $this->model('ads');
            $ad = $Ad->addAd($user_id, $ad_type, $url_path, $description, $url, $start_date, $end_date, $cost, $is_active);
            // TODO: Create error page for displaying messages and use sessions for showing messages.
            if (!$ad) {
                Session::add('feedback_negative', 'Error saving promotion. Please try again.');
            }
        }

        // where to go after vehicle_request has been added
        Redirect::to('fitnessbar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Ad
     */
    public function show($id) {

    }

    /**
     * ACTION: Show the form for editing the specified resource.
     * @param int $id Id of ad
     */
    public function edit($id)
    {
        if (isset($id)) {
            $Ad = $this->model('ads');

            $user_id = Session::get('id');
            $ad = $Ad->getAd($user_id, $id);

            $this->view->render('fitnessbar/edit', array('ad' => $ad));
        } else {
            // redirect user to requests index page (as we don't have a request_id)
            Redirect::to('fitnessbar/index');
        }
    }

    /**
     * ACTION: Update the specified resource in storage.
     */
    public function update($id)
    {
        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_update_ad"])) {
            $user_id = Session::get('id');
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $url = filter_var($_POST['url'], FILTER_SANITIZE_STRING);
            $cost = (float)filter_var($_POST['cost'], FILTER_SANITIZE_STRING);
            $start_date = filter_var($_POST['start_date'], FILTER_SANITIZE_STRING);
            $end_date = filter_var($_POST['end_date'], FILTER_SANITIZE_STRING);
            $is_active = filter_var($_POST['is_active'], FILTER_SANITIZE_STRING);
            $file_path = '';
            $ad_type = '';

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
                    $prod_image_path = $file_name;
                    if (move_uploaded_file($file_tmp, ASSET_ROOT . '/img/' . $file_name)) {
                        echo "File is valid, and was successfully uploaded.\n";
                    } else {
                        die("Upload failed");
                    }
                }else{
                    print_r($errors);
                }
            }

            $Ad = $this->model('ads');
            $ad = $Ad->updateAd($user_id, $id, $ad_type, $file_path, $description, $url, $start_date, $end_date, $cost, $is_active);
            
            if (!$ad) {
                Redirect::to('fitnessbar/edit/' . $id);
            }
        }

        // where to go after vehicle_request has been added
        Redirect::to('fitnessbar/index');
    }
    
    /**
     * Delete.
     */
    public function delete($id)
    {
        if (isset($_POST["submit_delete_ad"])) {
            $user_id = Session::get('id');
            $Ad = $this->model('ads');
            $Ad->deleteAd($user_id, $id);
        }

        // where to go after vehicle_request has been added
        Redirect::to('fitnessbar/index'); 
    }

    public function show_bar() {
        if (Session::userIsLoggedIn() && $this->is_contributer(Session::get('id'))) {
            return true;
        }
        return false;
    }
}
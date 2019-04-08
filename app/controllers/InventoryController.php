<?php

/**
 * The inventory controller, called when no controller/method has been passed
 * to the application.
 */
class InventoryController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        $Product = $this->model('product');

        $q = ''; // Search string
        $user_id = Session::get('id');

        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_search_inventory"])) {
            $q = filter_var($_POST['q'], FILTER_SANITIZE_STRING);
            
            $products = $Product->getProducts($user_id, $q);
        } else {
            $products = $Product->getAllProducts($user_id); // getting all items
        }

        // load views. within the views we can echo out $products easily
        $this->view->render('products/index', [
            'products' => $products,
            'q' => $q,
            'show_bar' => $this->show_bar(),
        ]);
    }

    /**
     * ACTION: Show the form for creating a new resource.
     */
    public function create()
    {
        $Product = $this->model('product');
        $categories = $Product->getAllCategories();

        // load views. within the views we can echo out $products easily
        $this->view->render('products/create', [
            'categories' => $categories
        ]); 
    }

    /**
     * Create a new admin object and stores to the database.
     *
     * @return void
     */
    public function store() {
        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_add_product"])) {
            
            // $prod_image_path = filter_var($_POST['prod_image_path'], FILTER_SANITIZE_STRING);
            $user_id = Session::get('id');
            $product_name = filter_var($_POST['product_name'], FILTER_SANITIZE_STRING);
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $category_id = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
            $is_public = filter_var($_POST['is_public'], FILTER_SANITIZE_STRING);
            $cost = (float)filter_var($_POST['cost'], FILTER_SANITIZE_STRING);
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

            $Product = $this->model('product');
            $product = $Product->addProduct($product_name, $description, $user_id, $category_id, $is_public, $cost,$prod_image_path);

            // TODO: Create error page for displaying messages and use sessions for showing messages.
            if (!$product) {
                die('Error saving product');
            }
        }

        // where to go after vehicle_request has been added
        Redirect::to('inventory');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Product
     */
    public function show($id) {

    }

    /**
     * ACTION: Show the form for editing the specified resource.
     * @param int $id Id of product
     */
    public function edit($id)
    {
        if (isset($id)) {
            $Product = $this->model('product');

            $product = $Product->getProduct($id);
            $categories = $Product->getAllCategories();

            $this->view->render('products/edit', array('product' => $product, 'categories' => $categories));
        } else {
            // redirect user to requests index page (as we don't have a request_id)
            Redirect::to('inventory/index');
        }
    }

    /**
     * ACTION: Update the specified resource in storage.
     */
    public function update($id)
    {
        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_update_product"])) {
            $user_id = Session::get('id');
            $product_name = filter_var($_POST['product_name'], FILTER_SANITIZE_STRING);
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $category_id = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
            $is_public = filter_var($_POST['is_public'], FILTER_SANITIZE_STRING);
            $cost = (float)filter_var($_POST['cost'], FILTER_SANITIZE_STRING);
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

            $Product = $this->model('product');
            $product = $Product->updateProduct($user_id, $id, $product_name, $description, $category_id, $is_public, $cost, $prod_image_path);

            if (!$product) {
                Redirect::to('inventory/edit/' . $id);
            }
        }

        // where to go after vehicle_request has been added
        Redirect::to('inventory/index');
    }
    
    /**
     * Delete
     */
    public function delete($id)
    {
        if (isset($_POST["submit_delete_product"])) {
            $Product = $this->model('product');
            $Product->deleteProduct($id);
        }

        // where to go after vehicle_request has been added
        Redirect::to('inventory/index'); 
    }

    public function show_bar() {
        if (Session::userIsLoggedIn() && $this->is_contributer(Session::get('id'))) {
            return true;
        }
        return false;
    }
}
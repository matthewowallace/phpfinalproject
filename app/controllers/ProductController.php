<?php

/**
 * The default home controller, called when no controller/method has been passed
 * to the application.
 */
class ProductController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        $Product = $this->model('product');
        $products = $Product->getAllProducts(); // getting all items

        // load views. within the views we can echo out $products easily
        $this->view->render('products/index', [
            'products' => $products
        ]);
    }

    /**
     * ACTION: Show the form for creating a new resource.
     *
     * This method handles what happens when you move to http://yourproject/user/addRequest
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "add a admin" form on user/index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to user/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function create()
    {
        // TODO: Get values from database
        $categories = [1 => 'Energy Drink', 2 => 'Protien Bar'];

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
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $user_id = Session::get('id');
            $category_id = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
            $is_public = filter_var($_POST['is_public'], FILTER_SANITIZE_STRING);
            $cost = (float)filter_var($_POST['cost'], FILTER_SANITIZE_STRING);

            $Product = $this->model('product');
            $product = $Product->addProduct($prod_image_path="", $description, $user_id, $category_id, $is_public, $cost);

            // TODO: Create error page for displaying messages and use sessions for showing messages.
            if (!$product) {
                die('Error saving product');
            }
        }

        // where to go after vehicle_request has been added
        Redirect::to('product');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

     /**
     * ACTION: Show the form for editing the specified resource.
     * This method handles what happens when you move to http://yourproject/user/editsong
     * @param int $id Id of the to-edit admin
     */
    public function edit($id)
    {
        if (!$this->Permission->hasAnyRole(['power-user','data-entry'])) {
            Redirect::toError();
        }

        if (isset($id)) {
            $Vehicles = new Vehicle();
            $vehicle = $Vehicles->getVehicle($id);

            $Facility = new Facility();
            $facilities = $Facility->getAllFacilities();

            // load views. within the views we can echo out $vehicle_request easily
            $this->View->render('vehicles/edit', array('vehicle' => $vehicle, 'facilities' => $facilities));
        } else {
            // redirect user to requests index page (as we don't have a request_id)
            Redirect::to('vehicles/index');
        }
    }

    /**
     * ACTION: Update the specified resource in storage.
     *
     * This method handles what happens when you move to http://yourproject/user/updatesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a admin" form on user/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to user/index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function update($id)
    {
        if (!$this->Permission->hasAnyRole(['power-user','data-entry'])) {
            Redirect::toError();
        }
        
        // if we have POST data to create a new vehicle_request entry
        if (Request::isset("submit_update_vehicle")) {
            $Vehicles = new Vehicle();
            $Vehicles->updateVehicle($id, Request::post('license_plate'), Request::post('vehicle_type'), Request::post('body_type'), Request::post('make'), Request::post('model'), Request::post('year'), Request::post('transmission'), Request::post('fuel'), Request::post('production_year'), Request::post('facility_id'), Request::post('engine_number'), Request::post('chasis_number'), Request::post('colour'), Request::post('seating'), Request::post('cc_rating'), Request::post('fitness_expiration'), Request::post('license_expiration'), Request::post('next_maintenance'), Request::post('is_available'), Request::post('is_operable'));
        }

        // where to go after vehicle_request has been added
        Redirect::to('vehicles/index');
    }

    /**
     * ACTION: Remove the specified resource from storage.
     * 
     * This method handles what happens when you move to http://yourproject/user/deletesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a admin" button on user/index
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to user/index via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $song_id Id of the to-delete admin
     */
    public function delete($id)
    {
    
    }
}
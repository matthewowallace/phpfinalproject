<?php

/**
 * The inventory controller, called when no controller/method has been passed
 * to the application.
 */
class CartController extends Controller
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

        $Cart = $this->model('cart');
        $user_id = Session::get('id');
        $shopping_cart = $Cart->getCart($user_id);

        // load views. within the views we can echo out $carts easily
        $this->view->render('cart/index', [
            'shopping_cart' => $shopping_cart,
        ]);
    }

    /**
     * Create a new admin object and stores to the database.
     *
     * @return void
     */
    public function add($product_id) {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        // if we have POST data to create a new vehicle_request entry
        if (isset($_POST["submit_add_cart"])) {
            
            // $prod_image_path = filter_var($_POST['prod_image_path'], FILTER_SANITIZE_STRING);
            $user_id = Session::get('id');
            $cost = (float)filter_var($_POST['cost'], FILTER_SANITIZE_STRING);
            $quantity = (int)filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);

            $Cart = $this->model('cart');
            $cart = $Cart->addCart($user_id, (int)$product_id, $cost, $quantity);

            // TODO: Create error page for displaying messages and use sessions for showing messages.
            if (!$cart) {
                die('Error saving cart');
            }
        }

        // where to go after vehicle_request has been added
        Redirect::to('shop');
    }

    /**
     * ACTION: Update the specified resource in storage.
     */
    public function update($id)
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        // where to go after vehicle_request has been added
        Redirect::to('cart');
    }
    
    /**
     * Checkout form
     * @return [type] [description]
     */
    public function checkout()
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        $Cart = $this->model('cart');
        $shopping_cart = $Cart->getCart(Session::get('id'));
        $cards = $Cart->getCards(Session::get('id'));

        $this->view->render('cart/checkout', [
            'shopping_cart' => $shopping_cart,
            'cards' => $cards,
        ]);
    }

    /**
     * Complete purchase
     * @return function [description]
     */
    public function done()
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        if (isset($_POST['submit_complete_purchase'])) {
            
            $is_dirty = false;
            
            // Get items from cart
            $Cart = $this->model('cart');
            $card_id = null;
            $shopping_cart = $Cart->getCart(Session::get('id'));
            $user_id = Session::get('id');
            $current_date = date("Y-m-d");

            if (!empty($_POST['credit_card'])) {
                // Get credit card from file.
                $card_id = (int)filter_var($_POST['credit_card'], FILTER_SANITIZE_STRING);
                if (!$Cart->cardExists($card_id)) {
                    Session::add('feedback_negative', 'Credit card not found');
                    Redirect::to('cart/checkout');
                    exit();
                }

            } else {

                $holder_name = filter_var($_POST['card_holder_name'], FILTER_SANITIZE_STRING);
                $card_number = filter_var($_POST['card_number'], FILTER_SANITIZE_STRING);
                $card_type = filter_var($_POST['card_type'], FILTER_SANITIZE_STRING);
                $expiry_month = filter_var($_POST['expiry_month'], FILTER_SANITIZE_STRING);
                $expiry_year = filter_var($_POST['expiry_year'], FILTER_SANITIZE_STRING);
                $cvv_code = filter_var($_POST['cvv'], FILTER_SANITIZE_STRING);

                $card_id = $Cart->addCard($user_id, $holder_name, $card_number, $card_type, $expiry_month, $expiry_year, $cvv_code, $current_date);
            }

            if ($card_id) {
                // This will be use to group items together to show
                // they were purchased at the same time.
                $cart_token = time();

                foreach ($shopping_cart as $item) {
                   $saved = $Cart->saveOrder($user_id, $item->product_id, $current_date, $item->cost, $item->quantity, $item->total, $card_id, $cart_token);

                    if ($saved) {
                        $Cart->deleteCart($item->id);
                    }
               }
            }

            Redirect::to('cart/summary');
        } 

        Redirect::to('cart');
    }

    /**
     * Delete
     */
    public function delete($id)
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }

        if (isset($_POST["submit_remove_product"])) {
            $Cart = $this->model('cart');
            $Cart->deleteCart($id);
        }

        // where to go after vehicle_request has been added
        Redirect::to('cart');
    }

    public function summary()
    {
        if (!Session::userIsLoggedIn()) {
            Redirect::to('user/login');
        }
        
        // load views. within the views we can echo out $carts easily
        $this->view->render('cart/summary', []);
    }
}
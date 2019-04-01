<?php

/**
 * The default ecommerce controller, called when no controller/method has been passed
 * to the application.
 */
class ShopController extends Controller
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
        if (isset($_POST["submit_search_shop"])) {
            $q = filter_var($_POST['q'], FILTER_SANITIZE_STRING);
            
            $products = $Product->getProducts($user_id, $q);
        } else {
            $products = $Product->getAllProducts();
        }

        $brands = $Product->getAllBrands();
        $categories = $Product->getAllCategories();

        // load views. within the views we can echo out $products easily
        $this->view->render('shop/index', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            ]
        );
    }

    /**
     * The default controller method.
     *
     * @return void
     */
    public function seller($id)
    {        
        // TODO: Add search filter
        $product = $this->model('product');
        $products = $product->getSellerProducts($id, $q="");

        // load views. within the views we can echo out $products easily
        $this->view->render('shop/index', [
            'products' => $products,
            ]
        );
    }
}


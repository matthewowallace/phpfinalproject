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
        
        $product = $this->model('product');
        $products = $product->getAllProducts();
        $brands = $product->getAllBrands();
        $categories = $product->getAllCategories();

        // load views. within the views we can echo out $products easily
        $this->view->render('shop/index', [
            'products' => $products,
            'brands' => $brands,
            'categories' => $categories,
            ]
        );
    }    
}


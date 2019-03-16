<?php

/**
 * The default ecommerce controller, called when no controller/method has been passed
 * to the application.
 */
class EcommerceController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        
        $ecommerce = $this->model('Ecommerce');
        $brands = $ecommerce->get_brand();

        // load views. within the views we can echo out $products easily
        $this->view->render('Ecommerce/index',['brands' => $brands]);


    }


    
}


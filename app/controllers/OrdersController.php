<?php

/**
 * The default home controller, called when no controller/method has been passed
 * to the application.
 */
class OrdersController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        $User = $this->model('order');
        $orders = $User->getAllOrders(SESSION::get('id'));
        $myorders = array();

        foreach ($orders as $order) {
            $myorders[$order->order_date][] = $order;
        }
        // echo '<pre>';
        // var_dump($myorders);
        // echo '</pre>';
        // die();
        $this->view->render('orders/index', [
            'orders' => $myorders,
        ]);
    }
}

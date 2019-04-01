<?php

/**
 * The default home controller, called when no controller/method has been passed
 * to the application.
 */
class ContactController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        $this->view->render('home/contact');
    }
}
<?php

/**
 * The default home controller, called when no controller/method has been passed
 * to the application.
 */
class HomeController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index($name = '', $mood = '')
    {
        // die(var_dump(Session::get('username')));
        $User = $this->model('user');
        $user = $User->getUserByUsername(SESSION::get('username'));

        $this->view->render('home/index', [
            'name' => $user,
            'mood' => $mood
        ]);
    }
}

<?php

/**
 * The default home controller, called when no controller/method has been passed
 * to the application.
 */
class AdminController extends Controller
{
    /**
     * The default controller method.
     *
     * @return void
     */
    public function index()
    {
        $User = $this->model('user');
        $users = $User->getUsers();

        $this->view->render_admin('admin/index', [
            'users' => $users,
        ]);
    }

    public function users()
    {
        $User = $this->model('user');
        $users = $User->getUsers();

        $this->view->render_admin('admin/index', [
            'users' => $users,
        ]);
    }
}

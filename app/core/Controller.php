<?php

/**
 * The controller class.
 *
 * The base controller for all other controllers. Extend this for each
 * created controller and get access to it's wonderful functionality.
 */
class Controller
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * @var View View The view object
     */
    public $view;

    public $Perm;

    /**
     * Construct the (base) controller. This happens when a real controller is constructed, like in
     * the constructor of IndexController when it says: parent::__construct();
     */
    public function __construct()
    {
        // Sets the number of items in cart.
        global $cart_count;

        // Always initialize a session
        Session::init();

        // NOTE: Create a new permission object.
        // $this->Permission = new Permission();

        $this->openDatabaseConnection();

        // Create view object to use it inside a controller, like $this->View->render();
        $this->view = new View();

        if (Session::userIsLoggedIn()) {
            // Get items in cart since this will be showed on every view
            $Cart = $this->model('cart');
            $cart_count = $Cart->getCount(Session::get('id'));
        }

        $Perm = $this->model('permission');
    }

    /**
     * Open the database connection with the credentials from application/config/config.php
     */
    private function openDatabaseConnection()
    {
        // set the (optional) options of the PDO connection. in this case, we set the fetch mode to
        // "objects", which means all results will be objects, like this: $result->user_name !
        // For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
        // @see http://www.php.net/manual/en/pdostatement.fetch.php
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);

        // generate a database connection, using the PDO connector
        // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }

    /**
     * Load a model
     *
     * @param string $model The name of the model to load
     *
     * @return object
     */
    public function model($model)
    {
        require_once '../app/models/' . ucfirst($model) . '.php';

        return new $model($this->db);
    }

    public function is_admin($user_id)
    {
        $Permission = $this->model('permission');
        return $Permission->is_admin($user_id);
    }

    public function is_contributer($user_id)
    {
        $Permission = $this->model('permission');
        return $Permission->is_contributer($user_id);
    }
}

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

    public function users($action=null, $id=null)
    {
        $User = $this->model('user');
        
        if (isset($_POST['submit_add_user_admin'])) {
            $is_dirty = false;

            // Sanitize and validate information.
            $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
            $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
            $image_path = '';

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            if ($password !== $cpassword) {
                Session::add('feedback_negative', 'Passwords does not match');
                $is_dirty = true;
            }

            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {                
                Session::add('feedback_negative', 'Invalid email entered');
                $is_dirty = true;
            }

            if (isset($_FILES['image'])){
                $errors= array();
                $file_name = $_FILES['image']['name'];
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
                
                $extensions= array("jpeg","jpg","png");
                
                if (in_array($file_ext, $extensions) === false){
                    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }
                
                // if ($file_size > 2097152){
                //     $errors[]='File size must be less then than 2 MB';
                // }
                
                if (empty($errors) == true) {
                    $image_path = URL . '/uploads/' . $file_name;
                    if (move_uploaded_file($file_tmp, ASSET_ROOT . '/uploads/' . $file_name)) {
                        echo "File is valid, and was successfully uploaded.\n";
                    } else {
                        Session::add('feedback_negative', 'Upload failed');
                    }
                }else{
                    Session::add('feedback_negative', $errors);
                }
            }

            $successful = false;

            if (!$is_dirty) {
                $User = $this->model('User');
                $user_id = (int)filter_var($_POST['user_id'], FILTER_SANITIZE_STRING);
                $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
                $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
                $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
                $is_subscriber = isset($_POST['is_subscriber']) ? (int)filter_var($_POST['is_subscriber'], FILTER_SANITIZE_STRING) : 0;
                $is_contributer = isset($_POST['is_contributer']) ? (int)filter_var($_POST['is_contributer'], FILTER_SANITIZE_STRING) : 0;
                $is_admin = isset($_POST['is_admin']) ? (int)filter_var($_POST['is_admin'], FILTER_SANITIZE_STRING) : 0;
                
                if ($action == 'store') {
                    // Save user if error return false
                    $sucessful = $User->addUser($username, $first_name, $last_name, $email, $password_hash, $is_subscriber, $is_contributer, $is_admin, $image_path);
                }

                if ($action == 'update') {
                    $sucessful = $User->updateUser($user_id, $username, $first_name, $last_name, $email, $password_hash, $is_subscriber, $is_contributer, $is_admin, $image_path);
                }
            }

            if ($sucessful) {
                Redirect::to('admin/users');
            } else {
                Redirect::to('admin/users/add');
            }
        }

        if ($action == 'delete' && $id) {
            $User->deleteUser($id);
            Redirect::to('admin/users');
        }

        if ($action == 'add') {
            $this->view->render_admin('admin/user', [
                'user' => [],
            ]);

        } if ($action == 'edit' && $id) {
            $user = $User->getUserById($id);
            $this->view->render_admin('admin/user', [
                'user' => $user,
            ]);

        } else {
            $users = $User->getUsers();
            $this->view->render_admin('admin/index', [
                'users' => $users,
            ]);
        }        
    }

    public function contacts()
    {
        $Contacts = $this->model('contact');
        $contacts = $Contacts->getContacts();

        $this->view->render_admin('admin/contact', [
            'contacts' => $contacts,
        ]);
    }

    public function category($action=null, $id=null)
    {
        $Category = $this->model('product');
        if ($action == 'delete' && $id) {
            $Category->deleteCategory($id);
            Redirect::to('admin/category');
        }

        if ($action == 'add') {
            $category_name = filter_var($_POST['category_name'], FILTER_SANITIZE_STRING);
            $Category->addCategory($category_name);
            Redirect::to('admin/category');
        }

        $categories = $Category->getAllCategories();

        $this->view->render_admin('admin/category', [
            'categories' => $categories,
        ]);
    }

    public function brand($action=null, $id=null)
    {
        $Brand = $this->model('product');
        if ($action == 'delete' && $id) {
            $Brand->deleteBrand($id);
            Redirect::to('admin/brand');
        }

        if ($action == 'add') {
            $brand_name = filter_var($_POST['brand_name'], FILTER_SANITIZE_STRING);
            $Brand->addBrand($brand_name);
            Redirect::to('admin/brand');
        }

        $brands = $Brand->getAllBrands();

        $this->view->render_admin('admin/brand', [
            'brands' => $brands,
        ]);
    }
}

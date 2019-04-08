<?php

class User
{
    /**
     * @param object $db A PDO database connection
     */
    function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    /**
     * Get all users.
     * @return [type] [description]
     */
    public function getUsers()
    {
        $sql = "SELECT `id`, `username`, `first_name`, `last_name`, `password`, `email`, `is_admin`, `is_contributer`, `subscription_plan`, `is_subscriber`, `subscription_start`, `subscription_end`, `created_at`, `updated_at` FROM `users`";
        $query = $this->db->prepare($sql);

        $query->execute();

        if (!$query) {
            Session::add('feedback_negative', 'An error occured. Please try again.');
            return false;
        }

        // fetch() is the PDO method that get exactly one result
        return $query->fetchAll();
    }

    /**
     * Add a user to database.
     * 
     * @param string $username
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     */
    public function addUser($username, $first_name, $last_name, $email, $password, $is_subscriber=1, $is_contributer=0, $is_admin=0, $image_path=null)
    {
        $user = $this->getUserbyEmail($email);

        if (!$user) {
            $sql = "INSERT INTO users (username, first_name, last_name, email, password, is_subscriber, is_contributer, is_admin, image_path) VALUES (:username, :first_name, :last_name, :email, :password, :is_subscriber, :is_contributer, :is_admin, :image_path)";
            
            // if (!is_null($password)) {
            //     $sql .= ',`password`=:password ';
            // }

            $query = $this->db->prepare($sql);

            $parameters = array(':username' => $username, ':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':password' => $password, ':is_subscriber' => $is_subscriber, ':is_contributer' => $is_contributer, ':is_admin' => $is_admin, ':image_path' => $image_path);
    
            // useful for debugging: you can see the SQL behind above construction by using:
            // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
    
            $query->execute($parameters);
    
            if (!$query) {
                Session::add('feedback_negative', 'An error occured registration. Please try again.');
                return false;
            }
    
            return true; 
        } else {
            Session::add('feedback_negative', 'E-mail address is already registered.');
            return false;
        }
    }

    /**
     * Update user to database.
     * 
     * @param string $username
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     */
    public function updateUser($id, $username, $first_name, $last_name, $email, $password, $is_subscriber=1, $is_contributer=0, $is_admin=0, $image_path=null)
    {
        $sql = "UPDATE `users` SET `username`=:username,`first_name`=:first_name,`last_name`=:last_name,`email`=:email, `is_contributer`=:is_contributer, `is_subscriber`=:is_subscriber, `is_admin`=:is_admin ";

        // Update password if set
        if (!is_null($password)) {
            $sql .= ',`password`=:password ';
        }

        if (!is_null($image_path)) {
            $sql .= ',`image_path`=:image_path ';
        }

        $sql .= 'WHERE `id`=:id';

        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':username' => $username, ':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':is_subscriber' => $is_subscriber, ':is_contributer' => $is_contributer, ':is_admin' => $is_admin);

        // Add password to parameters if set
        if (!is_null($password)) {
            $parameters[':password'] = $password;
        }

        if (!is_null($image_path)) {
            $parameters[':image_path'] = $image_path;
        }

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        if (!$query) {
            Session::add('feedback_negative', 'An error occured updating user. Please try again.');
            return false;
        }

        return true;
    }

    /**
     * Update user to database.
     * 
     */
    public function updateProfile($id, $image_path)
    {
        $sql = "UPDATE `users` SET `image_path`=:image_path WHERE `id`=:id";

        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':image_path' => $image_path);

        $query->execute($parameters);
        
        if (!$query) {
            Session::add('feedback_negative', 'An error occured updating user. Please try again.');
            return false;
        }

        return true;
    }

    /**
     * Get user with email address.
     *
     * @param string $email
     * @return User
     */
    public function getUserbyEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Gets user by username.
     *
     * @param string $username
     * @return object
     */
    public function getUserById($id)
    {
        $sql = "SELECT *
                FROM users
                WHERE (id = :id)
                LIMIT 1";
        
        // Executes query.
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        // return one row (we only have one result or nothing)
        return $query->fetch();
    }

    /**
     * Gets user by username.
     *
     * @param string $username
     * @return object
     */
    public function getUserByUsername($username)
    {
        $sql = "SELECT id, first_name, last_name, username, email, password
                FROM users
                WHERE (username = :username || email = :username)
                LIMIT 1";
        
        // Executes query.
        $query = $this->db->prepare($sql);
        $query->execute(array(':username' => $username));

        // return one row (we only have one result or nothing)
        return $query->fetch();
    }

    public function upgradeAccount($id, $agree)
    {
        $sql = "UPDATE `users` SET `is_contributer`=1 WHERE id=:id";
        
        // Executes query.
        $query = $this->db->prepare($sql);
        return $query->execute(array(':id' => $id));
    }

    /**
     * Authenticates user.
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function login($username, $password) 
    {
        $user = $this->getUserByUsername($username);

        // Credentials were not authenticated.
        if (!$user) {
            Session::add('feedback_negative', 'Email or password incorrect');
            return false;
        }

        // Check is password is correct.
        // @ref https://secure.php.net/manual/en/function.password-verify.php
        if (!password_verify($password, $user->password)) {
            Session::add('feedback_negative', 'Email or password incorrect');
            return false;
        }

        // Sets data into session.
        $this->setSession($user->id, $user->username, $user->email);

        return true;
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        return $query->execute($parameters);
    }

    /**
     * Sets the user's data into the session.
     *
     * @param $id
     * @param $username
     * @param $email
     */
    public function setSession($id, $username, $email)
    {
        Session::init();

        // Remove old and regenerate session ID.
        // It's important to regenerate session on sensitive actions,
        // and to avoid fixated session.
        // e.g. when a user logs in
        session_regenerate_id(true);
        $_SESSION = array();

        Session::set('id', $id);
        Session::set('username', $username);
        Session::set('email', $email);

        // Set user as logged-in
        Session::set('user_logged_in', true);
    }

    /**
     * Log out process delete session.
     */
    public function logout()
    {
        $id = Session::get('id');

        Session::destroy();
    }
}

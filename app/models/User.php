<?php

// use Illuminate\Database\Eloquent\Model as Eloquent;

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
     * Add a user to database.
     * 
     * @param string $username
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     */
    public function addUser($username, $first_name, $last_name, $email, $password)
    {
        $user = $this->getUserbyEmail($email);

        if (!$user) {
            $sql = "INSERT INTO users (username, first_name, last_name, email, password, is_subscriber) VALUES (:username, :first_name, :last_name, :email, :password, 1)";
            $query = $this->db->prepare($sql);
            $parameters = array(':username' => $username, ':first_name' => $first_name, ':last_name' => $last_name, ':email' => $email, ':password' => $password);
    
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

        // remove old and regenerate session ID.
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

<?php

class Contact
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
     * Get all request.
     * @return [type] [description]
     */
    public function getContacts()
    {
        $sql = "SELECT `id`, `name`, `email`, `message`, `created_at`, `updated_at` FROM `contact_us`";
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
     * Add a request to database.
     * 
     * @param string $username
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     */
    public function addContact($name, $email, $message)
    {
        $sql = "INSERT INTO contact_us (name, email, message) VALUES (:name, :email, :message)";
        $query = $this->db->prepare($sql);
        $parameters = array(':name' => $name, ':email' => $email, ':message' => $message);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        return $query->execute($parameters);
    }
}

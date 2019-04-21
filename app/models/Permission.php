<?php

/**
 * 
 */
class Permission
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

    public function is_admin($user_id)
    {
        $sql = "SELECT * FROM  `users` WHERE id=:user_id AND is_admin=1 LIMIT 1";
        
        $parameters = array(':user_id' => $user_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function is_contributer($user_id)
    {
        $sql = "SELECT * FROM  `users` WHERE id=:user_id AND is_contributer=1 LIMIT 1";
        
        $parameters = array(':user_id' => $user_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }
}
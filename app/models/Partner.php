<?php

class Partner
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
     * Gets all partners from database
     */
    public function getAllPartners($user_id=null)
    {
        $sql = "SELECT `partners`.`id`, `partners`.`name`, `partners`.`address`, `partners`.`contact`, `partners`.`email`, `users`.`username`, `partners`.`image_path`, `partners`.`created_at`, `partners`.`updated_at` FROM `partners`
        LEFT JOIN users ON `partners`.`user_id`=`users`.`id`";

        if ($user_id) {
            $sql .= " WHERE `partners`.`user_id`=:user_id";
        }

        // TODO: Query for the user that added the product
        $query = $this->db->prepare($sql);

        $parameters = [];
        if ($user_id) { 
            $parameters[':user_id'] = $user_id;
        }

        $query->execute($parameters);

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    /**
     * Gets all partners from database
     */
    public function getPartners($id=null, $q='')
    {
        $sql = "SELECT `partners`.`id`, `partners`.`name`, `partners`.`address`, `partners`.`contact`, `partners`.`email`, `users`.`username`, `partners`.`image_path`, `partners`.`created_at`, `partners`.`updated_at` FROM `partners`
        LEFT JOIN users ON `partners`.`user_id`=`users`.`id`
        WHERE `partners`.`name` LIKE :q";
        
        if ($id) {
            $sql .= " AND `partners`.`user_id`=:user_id";
        }

        $query = $this->db->prepare($sql);

        $parameters = array(':q' => '%' . trim($q) . '%');
        if ($id) { 
            $parameters[':user_id'] = $id;
        }
        $query->execute($parameters);
        
        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    public function addPartner($name, $address, $user_id, $contact, $email, $image_path="")
    {
        $sql = "INSERT INTO `partners`(`name`, `address`, `user_id`, `contact`, `email`, `image_path`) VALUES (:name, :address, :user_id, :contact, :email, :image_path)";

        $query = $this->db->prepare($sql);

        // $current_date = date("Y-m-d H:i:s");
        $parameters = array(':name' => $name, ':address' => $address, ':user_id' => $user_id, ':contact' => $contact, ':email' => $email, ':image_path' => $image_path);
        
        return $query->execute($parameters);
    }

    /**
     * Get a permission from database
     * @param integer $id
     */
    public function getPartner($id)
    {
        $sql = "SELECT `id`, `user_id`, `name`, `address`, `contact`, `email`, `image_path`, `created_at`, `updated_at` FROM `partners` WHERE partners.id=:id LIMIT 1";
        
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function updatePartner($user_id, $id, $name, $address, $contact, $email, $image_path="")
    {
        $sql = "UPDATE `partners` SET `name`=:name, `address`=:address,`contact`=:contact,`email`=:email ";

        // If image was uploaded use this query
        if (!empty($image_path)) {
            $sql .= ", `image_path`=:image_path ";
        }

        $sql .= "WHERE user_id=:user_id AND id=:id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':user_id' => $user_id, ':name' => $name, ':address' => $address, ':contact' => $contact, ':email' => $email);

        // If image was uploaded update path
        if (!empty($image_path)) { 
            $parameters[':image_path'] = $image_path;
        }

        return $query->execute($parameters);
        // die(var_dump($_POST));
    }

     /**
     * Deletes a request
     *
     * @param [type] $id
     * @return void
     */
    public function deletePartner($id)
    {
        $sql = "DELETE FROM partners WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        return $query->execute($parameters);
    }
}

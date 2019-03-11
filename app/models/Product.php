<?php

// use Illuminate\Database\Eloquent\Model as Eloquent;

class Product
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
     * getAllProducts
     * Gets all products from database
     */
    public function getAllProducts()
    {
        $sql = "SELECT `products`.`id`, `products`.`prod_image_path`, `products`.`description`, `products`.`brand`, `users`.`username`, `category`.`category_name` AS category, `products`.`is_public`, `products`.`cost`, `products`.`created_at`, `products`.`updated_at` FROM  `products`
        INNER JOIN users ON `products`.`user_id`=`users`.`id`
        INNER JOIN category ON `products`.`category_id`=`category`.`id`
        ";
        
        $query = $this->db->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute();

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    public function addProduct($prod_image_path="", $description, $user_id, $category_id, $is_public, $cost)
    {
        $sql = "INSERT INTO `products`(`prod_image_path`, `description`, `user_id`, `category_id`, `is_public`, `cost`) VALUES (:prod_image_path, :description, :user_id, :category_id, :is_public, :cost)";

        $query = $this->db->prepare($sql);

        // $current_date = date("Y-m-d H:i:s");
        $parameters = array(':prod_image_path' => $prod_image_path, ':description' => $description, ':user_id' => $user_id, ':category_id' => $category_id, ':is_public' => $is_public, ':cost' => $cost);
        
        return $result = $query->execute($parameters);
    }

    /**
     * Get a permission from database
     * @param integer $id
     */
    public function getProduct($id)
    {
        $sql = "SELECT products.`id`, products.`first_name`, products.`last_name`, products.facility_id, products.`is_active`, products.`created_at`, products.`updated_at` FROM  `products` WHERE products.id=:id LIMIT 1";
        
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function updateProduct($id, $firstname, $lastname, $facility_id, $active)
    {
        $sql = "UPDATE `products` SET `first_name`= :first_name,`last_name`= :last_name,`facility_id`=:facility_id,`is_active`=:is_active WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':first_name' => $firstname, ':last_name' => $lastname, ':facility_id' => $facility_id, ':is_active' => $active);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }
}

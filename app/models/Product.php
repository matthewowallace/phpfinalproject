<?php

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
     * Gets all products from database
     */
    public function getAllProducts()
    {
        $sql = "SELECT `products`.`id`, `products`.`prod_image_path`, `products`.`description`, `products`.`brand`, `users`.`username`, `category`.`category_name` AS category, `products`.`is_public`, `products`.`cost`, `products`.`created_at`, `products`.`updated_at` FROM  `products`
        LEFT JOIN users ON `products`.`user_id`=`users`.`id`
        LEFT JOIN category ON `products`.`category_id`=`category`.`id`
        ";
        
        $query = $this->db->prepare($sql);

        $query->execute();

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    /**
     * Gets all products from database
     */
    public function getProducts($q)
    {
        $sql = "SELECT `products`.`id`, `products`.`prod_image_path`, `products`.`description`, `products`.`brand`, `users`.`username`, `category`.`category_name` AS category, `products`.`is_public`, `products`.`cost`, `products`.`created_at`, `products`.`updated_at` FROM `products`
        LEFT JOIN users ON `products`.`user_id`=`users`.`id`
        LEFT JOIN category ON `products`.`category_id`=`category`.`id`
        WHERE `products`.`description` LIKE :qa
        ";
        
        $query = $this->db->prepare($sql);

        $parameters = array(':qa' => '%' . trim($q) . '%');
        $query->execute($parameters);
        
        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    public function addProduct($description, $user_id, $category_id, $is_public, $cost, $prod_image_path="")
    {
        $sql = "INSERT INTO `products`(`prod_image_path`, `description`, `user_id`, `category_id`, `is_public`, `cost`) VALUES (:prod_image_path, :description, :user_id, :category_id, :is_public, :cost)";

        $query = $this->db->prepare($sql);

        // $current_date = date("Y-m-d H:i:s");
        $parameters = array(':prod_image_path' => $prod_image_path, ':description' => $description, ':user_id' => $user_id, ':category_id' => $category_id, ':is_public' => $is_public, ':cost' => $cost);
        
        return $query->execute($parameters);
    }

    /**
     * Get a permission from database
     * @param integer $id
     */
    public function getProduct($id)
    {
        $sql = "SELECT `id`, `brand`, `prod_image_path`, `description`, `user_id`, `category_id`, `is_public`, `cost`, `created_at`, `updated_at` FROM  `products` WHERE products.id=:id LIMIT 1";
        
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    public function updateProduct($user_id, $id, $description, $category_id, $is_public, $cost, $prod_image_path="")
    {
        $sql = "UPDATE `products` SET `description`= :description,`category_id`= :category_id,`cost`=:cost,`is_public`=:is_public WHERE user_id=:user_id AND id=:id";

        // If image was uploaded use this query
        if (!empty($prod_image_path)) {
            $sql = "UPDATE `products` SET `description`= :description,`category_id`= :category_id,`cost`=:cost,`is_public`=:is_public, `prod_image_path`=:prod_image_path WHERE user_id=:user_id AND id=:id";
        }
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':user_id' => $user_id, ':description' => $description, ':category_id' => $category_id, ':cost' => $cost, ':is_public' => $is_public);

        // If image was uploaded update path
        if (!empty($prod_image_path)) { 
            $parameters[':prod_image_path'] = $prod_image_path;
        }
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        return $query->execute($parameters);
    }

     /**
     * Deletes a request
     *
     * @param [type] $id
     * @return void
     */
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    public function getAllCategories()
    {
        $sql = "SELECT `id`, `category_name`, `created_at`, `updated_at` FROM `category` ORDER BY category_name ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }


    public function getAllBrands()
    {
        $sql = "SELECT `id`, `brand_name`, `created_at`, `updated_at` FROM `brand` ORDER BY brand_name ASC";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}

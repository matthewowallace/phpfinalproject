<?php

class Cart
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
     * Gets all cart items from database
     */
    public function getCart($user_id)
    {
        $sql = "SELECT `shopping_cart`.`id`, `shopping_cart`.`product_id`, `products`.`product_name`, `products`.`prod_image_path`, `shopping_cart`.`date_added`, `shopping_cart`.`cost`, `shopping_cart`.`quantity`, `users`.`username`, `shopping_cart`.`total`, `shopping_cart`.`created_at`, `shopping_cart`.`updated_at`
        FROM `shopping_cart`
        INNER JOIN users ON `shopping_cart`.`user_id`=`users`.`id`
        INNER JOIN products ON `shopping_cart`.`product_id`=`products`.`id`
        WHERE `shopping_cart`.`user_id`=:user_id
        ";
        
        // TODO: Query for the user that added the product
        $query = $this->db->prepare($sql);

        $query->execute([':user_id' => $user_id]);

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    /**
     * Add product to shopping cart.
     * @param [type] $user_id    [description]
     * @param [type] $product_id [description]
     * @param [type] $cost       [description]
     * @param [type] $quantity   [description]
     */
    public function addCart($user_id, $product_id, $cost, $quantity)
    {
        $sql = "INSERT INTO `shopping_cart`(`user_id`, `product_id`, `date_added`, `cost`, `quantity`, `total`) VALUES (:user_id, :product_id, :date_added, :cost, :quantity, :total)";

        $query = $this->db->prepare($sql);

        $current_date = date("Y-m-d");
        $total = (float)$cost * (int)$quantity; // Calculate total

        $parameters = array(':user_id' => $user_id, ':product_id' => $product_id, ':date_added' => $current_date, ':cost' => $cost, ':quantity' => $quantity, ':total' => $total);
        
        return $query->execute($parameters);
    }

    /**
     * Get a permission from database
     * @param integer $id
     */
    public function getCount($user_id)
    {
        $sql = "SELECT count(*) as count FROM  `shopping_cart` WHERE `user_id`=:user_id";
        
        $parameters = array(':user_id' => $user_id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();
        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        $result = $query->fetch();
        return $result->count;
    }

    public function updateCart($user_id, $id, $product_name, $description, $category_id, $is_public, $cost, $prod_image_path="")
    {
        $sql = "UPDATE `products` SET `product_name`=:product_name, `description`=:description,`category_id`=:category_id,`cost`=:cost,`is_public`=:is_public ";

        // If image was uploaded use this query
        if (!empty($prod_image_path)) {
            $sql .= ", `prod_image_path`=:prod_image_path ";
        }

        $sql .= "WHERE user_id=:user_id AND id=:id";
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':user_id' => $user_id, ':product_name' => $product_name, ':description' => $description, ':category_id' => $category_id, ':cost' => $cost, ':is_public' => $is_public);

        // If image was uploaded update path
        if (!empty($prod_image_path)) { 
            $parameters[':prod_image_path'] = $prod_image_path;
        }
        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
        // die(var_dump($_POST));
    }

     /**
     * Deletes a request
     *
     * @param [type] $id
     * @return void
     */
    public function deleteCart($id)
    {
        $sql = "DELETE FROM shopping_cart WHERE id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id);

        // useful for debugging: you can see the SQL behind above construction by using:
        // echo '[ PDO DEBUG ]: ' . Helper::debugPDO($sql, $parameters);  exit();

        $query->execute($parameters);
    }

    /**
     * Gets all cards for users.
     */
    public function getCards($user_id)
    {
        $sql = "SELECT * FROM `credit_cards` WHERE `user_id`=:user_id
        ";
        
        // TODO: Query for the user that added the product
        $query = $this->db->prepare($sql);

        $query->execute([':user_id' => $user_id]);

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    /**
     * Check if a credit card is saved.
     * @param  [type] $card_id [description]
     * @return [type]          [description]
     */
    public function cardExists($card_id)
    {
        $sql = "SELECT * FROM `credit_cards` WHERE `id`=:card_id
        ";
        
        // TODO: Query for the user that added the product
        $query = $this->db->prepare($sql);

        $query->execute([':card_id' => $card_id]);

        // return one row (we only have one result or nothing)
        return $query->fetch();
    }

    /**
     * Save credit card.
     * @param [type] $user_id    [description]
     * @param [type] $product_id [description]
     * @param [type] $cost       [description]
     * @param [type] $quantity   [description]
     */
    public function addCard($user_id, $holder_name, $card_number, $card_type, $expiry_month, $expiry_year, $cvv_code, $date_added)
    {
        $sql = "INSERT INTO `credit_cards` (`user_id`, `holder_name`, `card_number`, `card_type`, `expiry_month`, `expiry_year`, `cvv_code`, `date_added`, `is_active`) VALUES (:user_id, :holder_name, :card_number, :card_type, :expiry_month, :expiry_year, :cvv_code, :date_added, 1)";

        $query = $this->db->prepare($sql);

        $parameters = array(':user_id' => $user_id, ':holder_name' => $holder_name, ':card_number' => $card_number, ':card_type' => $card_type, ':expiry_month' => $expiry_month, ':expiry_year' => $expiry_year, ':cvv_code' => $cvv_code, ':date_added' => $date_added);
        
        $query->execute($parameters);

        // Return new ID for card
        return $this->db->lastInsertId();
    }

    public function saveOrder($user_id, $product_id, $order_date, $cost, $quantity, $total, $card_id, $cart_token)
    {
        $sql = "INSERT INTO `orders` (`user_id`, `product_id`, `order_date`, `cost`, `quantity`, `total`, `card_id`, `cart_token`) VALUES (:user_id, :product_id, :order_date, :cost, :quantity, :total, :card_id, :cart_token)";

        $query = $this->db->prepare($sql);

        $parameters = array(':user_id' => $user_id, ':product_id' => $product_id, ':order_date' => $order_date, ':cost' => $cost, ':quantity' => $quantity, ':total' => $total, ':card_id' => $card_id, ':cart_token' => $cart_token);
        
        return $query->execute($parameters);
    }
}

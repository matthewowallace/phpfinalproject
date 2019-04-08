<?php

class Order
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
     * Gets all orders from database
     */
    public function getAllOrders($user_id=null, $limit=null)
    {
        $sql = "SELECT `orders`.`id`, `products`.`product_name`, `products`.`prod_image_path`, `orders`.`order_date`, `orders`.`cost`, `quantity`, `total`, `orders`.`cart_token`, `users`.`username`, `orders`.`cart_token`, `orders`.`created_at`
        FROM `orders`
        LEFT JOIN users ON `orders`.`user_id`=`users`.`id`
        LEFT JOIN products ON `orders`.`product_id`=`products`.`id`
        WHERE `orders`.`user_id`=:user_id
        ";
        
        if ($limit) {
            $sql .= ' LIMIT 3';
        }

        // TODO: Query for the user that added the product
        $query = $this->db->prepare($sql);

        $query->execute([':user_id' => $user_id]);

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }
}

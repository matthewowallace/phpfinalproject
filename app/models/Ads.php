<?php

class Ads
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
     * Gets all ads from database
     */
    public function getAllAds($user_id)
    {
        $sql = "SELECT `health_ads`.`id`, `users`.`username`, `health_ads`.`ad_type`, `health_ads`.`file_path`, `health_ads`.`description`, `health_ads`.`url`, `health_ads`.`start_date`, `health_ads`.`end_date`, `health_ads`.`cost`, `health_ads`.`is_active`, `health_ads`.`created_at`, `health_ads`.`updated_at` FROM  `health_ads`
        LEFT JOIN users ON `health_ads`.`user_id`=`users`.`id`
        WHERE `users`.`id`=:user_id
        ";
        
        $query = $this->db->prepare($sql);

        $query->execute([':user_id' => $user_id]);

        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    /**
     * Filter for ads from database
     */
    public function getAds($user_id, $q)
    {
        $sql = "SELECT `health_ads`.`id`, `users`.`username`, `health_ads`.`ad_type`, `health_ads`.`file_path`, `health_ads`.`description`, `health_ads`.`url`, `health_ads`.`start_date`, `health_ads`.`end_date`, `health_ads`.`cost`, `health_ads`.`is_active`, `health_ads`.`created_at`, `health_ads`.`updated_at` FROM  `health_ads`
        LEFT JOIN users ON `health_ads`.`user_id`=`users`.`id`
        WHERE `users`.`id`=:user_id AND `health_ads`.`description` LIKE :q
        ";
        
        $query = $this->db->prepare($sql);

        $parameters = array(':user_id' => $user_id, ':q' => '%' . trim($q) . '%');
        $query->execute($parameters);
        
        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    /**
     * Add new ad
     * @param [type] $user_id     [description]
     * @param [type] $ad_type     [description]
     * @param string $file_path   [description]
     * @param [type] $description [description]
     * @param [type] $url         [description]
     * @param [type] $start_date  [description]
     * @param [type] $end_date    [description]
     * @param [type] $cost        [description]
     * @param [type] $is_active   [description]
     */
    public function addAd($user_id, $ad_type="", $file_path="", $description, $url, $start_date, $end_date, $cost, $is_active)
    {
        $sql = "INSERT INTO `health_ads`(`user_id`, `ad_type`, `file_path`, `description`, `url`, `start_date`, `end_date`, `cost`, `is_active`) VALUES (:user_id, :ad_type, :file_path, :description, :url, :start_date, :end_date, :cost, :is_active)";

        $query = $this->db->prepare($sql);

        $parameters = array(':user_id' => $user_id, ':ad_type' => $ad_type, ':file_path' => $file_path, ':description' => $description, ':url' => $url, ':start_date' => $start_date, ':end_date' => $end_date, ':cost' => $cost, ':is_active' => $is_active);
        
        return $query->execute($parameters);
    }

    /**
     * Get a single ad
     * @param integer $id
     */
    public function getAd($user_id, $id)
    {
        $sql = "SELECT `id`, `user_id`, `ad_type`, `file_path`, `description`, `url`, `start_date`, `end_date`, `cost`, `is_active`, `created_at`, `updated_at` FROM  `health_ads` WHERE `user_id`=:user_id AND `id`=:id LIMIT 1";
        
        $parameters = array(':user_id' => $user_id, ':id' => $id);

        $query = $this->db->prepare($sql);
        $query->execute($parameters);

        // fetch() is the PDO method that get exactly one result
        return $query->fetch();
    }

    /**
     * Gets all products from database
     */
    public function getFitnessBar()
    {
        $sql = "SELECT `health_ads`.`id`, `health_ads`.`user_id`, `health_ads`.`ad_type`, `health_ads`.`file_path`, `health_ads`.`description`, `health_ads`.`url`, `health_ads`.`start_date`, `health_ads`.`end_date`, `health_ads`.`cost`, `health_ads`.`is_active`, `health_ads`.`created_at`, `health_ads`.`updated_at` FROM `health_ads`
        INNER JOIN users ON `health_ads`.`user_id`=`users`.`id`
        WHERE `health_ads`.`cost` <> NULL OR `health_ads`.`cost` > 0
        ";
        
        $query = $this->db->prepare($sql);

        // $parameters = array(':qa' => '%' . trim($q) . '%');
        $query->execute();
        
        // return one row (we only have one result or nothing)
        return $query->fetchAll();
    }

    /**
     * Update ad
     * @param  [type] $user_id         [description]
     * @param  [type] $id              [description]
     * @param  [type] $description     [description]
     * @param  [type] $category_id     [description]
     * @param  [type] $is_public       [description]
     * @param  [type] $cost            [description]
     * @param  string $prod_image_path [description]
     * @return [type]                  [description]
     */
    public function updateAd($user_id, $id, $ad_type, $file_path="", $description, $url, $start_date, $end_date, $cost, $is_active)
    {
        $sql = "UPDATE `health_ads` SET `ad_type`=:ad_type,`description`=:description,`url`=:url,`start_date`=:start_date,`end_date`=:end_date,`cost`=:cost,`is_active`=:is_active ";

        // If image was uploaded use this query
        if (!empty($file_path)) {
            $sql .= ',`file_path`=:file_path ';
        }

        $sql .= 'WHERE `user_id`=:user_id AND `id`=:id';
        
        $query = $this->db->prepare($sql);
        $parameters = array(':id' => $id, ':user_id' => $user_id, ':ad_type' => $ad_type, ':description' => $description, ':url' => $url, ':start_date' => $start_date, ':end_date' => $end_date, ':cost' => $cost, ':is_active' => $is_active);

        // If image was uploaded update path
        if (!empty($file_path)) { 
            $parameters[':file_path'] = $file_path;
        }

        $result = $query->execute($parameters);
        // die($result);
        return $result;
    }

     /**
     * Delete
     *
     * @param [type] $id
     * @return void
     */
    public function deleteAd($user_id,  $id)
    {
        $sql = "DELETE FROM `health_ads` WHERE user_id=:user_id AND id=:id";
        $query = $this->db->prepare($sql);
        $parameters = array(':user_id' => $user_id, ':id' => $id);

        return $query->execute($parameters);
    }
}

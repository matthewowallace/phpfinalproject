<?php

class Ecommerce{
	
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



/* contributor */
 	
 	function get_brand(){

 	 $query = "
                    SELECT *  FROM brand  ORDER BY brand_name ASC
                    ";
                    $statement = $this->db->prepare($query);
                    $statement->execute();
                    return $statement->fetchAll();
 	}



 	function get_category(){
 		 $query = "
                    SELECT *  FROM category  ORDER BY category_name ASC
                    ";
                    $statement = $this->db->prepare($query);
                    $statement->execute();
                    return $statement->fetchAll();
 	}

}
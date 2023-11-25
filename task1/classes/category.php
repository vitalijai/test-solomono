<?php

class Category {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

  
    public function getAllCategories() {
        $sql = "SELECT 
        Categories.category_id, 
        Categories.category_name, 
        COUNT(Products.product_id) AS product_count
    FROM 
        Categories
    LEFT JOIN 
        Products ON Categories.category_id = Products.category_id
    GROUP BY 
        Categories.category_id, 
        Categories.category_name";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}


?>
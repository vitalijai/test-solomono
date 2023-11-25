<?php


class Product {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

  
    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

  
    public function getProductsByCategory($category, $sortType='') {
        $defaultSort = "product_id"; 
        $sql = "SELECT * FROM Products WHERE category_id = '$category' ORDER BY ";

        switch ($sortType) {
            case 'price':
                $sql .= "price ASC";
                break;
            case 'name':
                $sql .= "product_name ASC";
                break;
            case 'date':
                $sql .= "date_added DESC";
                break;
            default:
                $sql .= "$defaultSort ASC"; 
                break;
        }
     
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}


?>
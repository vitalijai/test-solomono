<?php
include '../classes/product.php';
include '../classes/db.php';

if(isset($_GET['category'])) {
    $db = new Database();
    $product = new Product($db);

    $category = $_GET['category'];
    if(isset($_GET['sortType']))
        $sortType = $_GET['sortType'];

    $products = $product->getProductsByCategory($category,$sortType);

  
    $result = [];
    foreach($products as $product) {
        $result[] = [
            'name' => $product['product_name'],
            'price' => $product['price'],
            'date' => $product['date_added']
        ];
    }


    header('Content-Type: application/json');
    echo json_encode($result);
}

?>

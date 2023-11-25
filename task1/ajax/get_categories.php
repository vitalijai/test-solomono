<?php
include '../classes/category.php'; 


include '../classes/db.php';
$db = new Database();

$category = new Category($db); 


$categories = $category->getAllCategories();
echo json_encode($categories);
?>

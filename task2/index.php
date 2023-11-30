<?php
$start_time = microtime(true);


$servername = "sql273.your-server.de";
$username = "user_test";
$password = "oUkE790rB0sm6Bg2";
$dbname = "test11";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM categories";
$result = $conn->query($sql);

$data = $result->fetch_all(MYSQLI_ASSOC);


$indexed = [];
$tree = [];

foreach ($data as $row) {
    
    $indexed[$row['categories_id']] = [$row['categories_id']];
 
}

foreach ($data as $row) {
    
    if ($row['parent_id'] != 0) {
        $indexed[$row['parent_id']][$row['categories_id']] = &$indexed[$row['categories_id']];
    } else {
        $tree[$row['categories_id']] = &$indexed[$row['categories_id']];
    }
 
}

$end_time = microtime(true);
echo '<pre>';
print_r($tree);
echo '</pre>';

$conn->close();



$execution_time = $end_time - $start_time;

echo "Скрипт выполнен за $execution_time секунд";





<?php
$start_time = microtime(true);



function CreateTree($array,$parent=0)
{
    $tree = array();

    
    foreach($array as $category)
    {
        if($category['parent_id'] == $parent)
        {
            $tree[$category['categories_id']] = CreateTree($array, $category['categories_id']);;
        }
    }
    if (empty($tree))
        $tree = $parent;

    return $tree;
}


$servername = "sql273.your-server.de";
$username = "user_test";
$password = "oUkE790rB0sm6Bg2";
$dbname = "test11";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ошибка соединения: " . $conn->connect_error);
}

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
$tree = [];
if ($result->num_rows > 0) {

    $array = $result->fetch_all(MYSQLI_ASSOC);

    $tree = CreateTree($array);

} else {
    echo "Нет результатов";
}


$conn->close();




$end_time = microtime(true);
$execution_time = $end_time - $start_time;
echo '<pre>';
print_r($tree);
echo '</pre>';
echo "Скрипт выполнен за $execution_time секунд";
?>
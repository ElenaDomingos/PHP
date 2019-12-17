<?php
require_once('connection.php');

$arr = array();


$sql = "SELECT * FROM comments WHERE status = 'approved' ORDER BY email ASC";


$result = $pdo->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $result->fetch()) {
    $arr[] = $row;
}

echo json_encode($arr);
   
  

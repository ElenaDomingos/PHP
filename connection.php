<?php
try {

    $pdo = new PDO("mysql:host=localhost;dbname=shopf582_testphp;charset=utf8", 'shopf582_lena', 'mixus878');
} catch (PDOException $e) {


    echo "Erro " . $e->getMessage();
}

<?php
include 'count.php';

try {
    $pdo = new PDO('mysql:host=db;dbname=myapp', 'user', 'secret');
    $output = 'Database connection established.';
}
catch (PDOException $e) {
    $output = 'Unable to connect to the database server.' . $e;
}

include 'output.html.php';

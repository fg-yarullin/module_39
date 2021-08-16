<?php
extract(include __DIR__ . '/db_config.php');
$pdo = new PDO(
    "mysql:host=$host;
    dbname=$database;
    charset=$charset",
    $username,
    $password
);
$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);

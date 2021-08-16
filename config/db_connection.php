<?php
function get_connection() {
    extract(include 'db_config.php');
    return new PDO(
        "mysql:host=$host;
        dbname=$database;
        charset=$charset",
        $username,
        $password
    );
}

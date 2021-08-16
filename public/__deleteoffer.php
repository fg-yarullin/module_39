<?php
    try {
        include_once __DIR__ . '/../src/includes/DatabaseConnection.php';
        include_once __DIR__ . '/../app/models/DatabaseTable.php';

        $offersTable = new DatabaseTable($pdo, 'offer', 'id');
        $offersTable->delete($_POST['id']);
        header('location: offers.php');
    } catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage() . 'in ' .
        $e->getFile() . ':' . $e->getLine();
    }

include __DIR__ . '/../src/templates/layout.html.php';

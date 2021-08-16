<?php
try {
    include_once __DIR__ . '/../src/includes/DatabaseConnection.php';
    include_once __DIR__ . '/../app/models/DatabaseTable.php';

    $offersTable = new DatabaseTable($pdo, 'offer', 'id');
    $usersTable = new DatabaseTable($pdo, 'user', 'id');
    // $offers = allOffers($pdo);
    $result = $offersTable->findAll();
    $offers = [];
    foreach ($result as $offer) {
        $user = $usersTable->findById($offer['userid']);
        $offers[] = [
            'id' => $offer['id'],
            'offertext' => $offer['offertext'],
            'offerdate' => $offer['offerdate'],
            'name' => $user['name'],
            'email' => $user['email']
        ];
    }
    $title = 'Offers List';
    $totalOffers = $offersTable->total();
    $output = '';
    ob_start();
    include __DIR__ . '/../src/templates/offers.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . 'in ' .
    $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../src/templates/layout.html.php';

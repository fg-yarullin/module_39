<?php
include_once __DIR__ . '/../src/includes/DatabaseConnection.php';
include_once __DIR__ . '/../app/models/DatabaseTable.php';

$offersTable = new DatabaseTable($pdo, 'offer', 'id');

try {
    $primaryKey = 'id';
    if (isset($_POST['offer'])) {
        // $fields = ['id' => $_POST['offerid'], 'offertext' => $_POST['offertext'], 'offerdate' => new DateTime(), 'userid' => $_POST['userid'] = 1];
        // update($pdo, 'offer', $primaryKey, $fields);
        $offer = $_POST['offer'];
        $offer['userid'] = 2;
        $offer['offerdate'] = new DateTime();
        $offersTable->save($offer);
        header('location: offers.php');
    } else {
        if (isset($_GET['id'])) {
            $offer = $offersTable->findById($_GET['id']);
        }
        $title = 'Edit Offer';
        ob_start();
        include __DIR__ . '/../src/templates/editoffer.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . 'in ' .
    $e->getFile() . ':' . $e->getLine();
}
include __DIR__ . '/../src/templates/layout.html.php';

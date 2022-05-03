<?php
namespace Controllers;
use Models\DatabaseTable;
use DateTime;
use Controllers\Auth\Authentication;

class OfferController {
    private $usersTable;
    private $offersTable;
    private $categoriesTable;
    private $authentication;

    public function __construct(DatabaseTable $offersTable, DatabaseTable $usersTable, Authentication $authentication, DatabaseTable &$categoriesTable) {
        $this->offersTable = $offersTable;
        $this->usersTable = $usersTable;
        $this->categoriesTable = $categoriesTable;
        $this->authentication = $authentication;
    }

    public function home():array {
        $title = 'Offer Database';
        return ['title' => $title, 'template' => 'home.html.php'];
    }

    public function list():array {
        $page = $_GET['page'] ?? 1;
        $offset = ($page - 1) * 5;
        $user = $this->authentication->getUser();
        if (isset($_GET['category'])) {
            $category = $this->categoriesTable->findById($_GET['category']);
//            $offers = $category->getOffers(5, $offset);
            var_dump($category);
            $offers = $category->find('userId', $user->id);
        } else {
//            $offers = $this->offersTable->findAll('offerdate DESC', 5, $offset);
            $offers = $this->offersTable->find('userid',$user->id ,null, 5, $offset);
        }
        $totalOffers = count($offers);
        $title = 'Offers List';
        $variables = [
            'totalOffers' => $totalOffers,
            'offers' => $offers,
            'user' => $user,
            'categories' => $this->categoriesTable->findAll(),
            'currentPage' => $page,
            'categoryId' => $_GET['category'] ?? null
        ];

        return [
            'title' => $title,
            'template' => 'offers.html.php',
            'variables' => $variables
        ];
    }

    public function edit() {
        $user = $this->authentication->getUser();
        $categories = $this->categoriesTable->findAll();

        if (isset($_GET['id'])) {
            $offer = $this->offersTable->findById($_GET['id']);
        }
        $title = 'Edit Offer';
        $variables = [
            'offer' => $offer ?? null,
            'user' => $user,
            'categories' => $categories
        ];

        return [
            'title' => $title,
            'template' => 'editoffer.html.php',
            'variables' => $variables
        ];
    }

    public function saveEdit() {
        $user = $this->authentication->getUser();

        if (isset($_GET['id']) && isset($_POST['offer'])) {
            $id = $_POST['offer']['id'];
            $offer = $this->offersTable->findById($id);
            if ($offer->userId != $user->id) {
                header('location: /user/permissions/error');
                return;
            }
        }

        $offer = $_POST['offer'];
        $offer['offerdate'] = new DateTime();

        $offerEntity = $user->addOffer($offer);
        // var_dump($offerEntity); return;

        $offerEntity->clearCategories();

        foreach ($_POST['category'] as $categoryId) {
            $offerEntity->addCategory($categoryId);
        }

        header('location: /offer/list');
    }

    public function delete() {
        $user = $this->authentication->getUser();
        $offer = $this->offersTable->findById($_POST['id']);

        if ($offer->userId != $user->id && $user->hasPermission(\Models\User::DELETE_OFFERS)) {
            header('location: /user/permissions/error');
            return;
        }

        $this->offersTable->delete($_POST['id']);
        header('location: /offer/list');
    }
}

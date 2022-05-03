<?php

namespace App\Controllers;

use Models\DatabaseTable;

class CategoryOffersController
{
    private $usersTable;
    private $offersTable;
    private $categoriesTable;
    private $authentication;
    private $categoryOffers;

    public function __construct(DatabaseTable $categoryOffers, DatabaseTable $categoriesTable, DatabaseTable $offersTable, DatabaseTable $authentication){
        $this->categoryOffers = $categoryOffers;
        $this->offersTable = $offersTable;
        $this->authentication = $authentication;
        $this->categoriesTable = $categoriesTable;
    }

    public function getOffersByCategory($category_id){
        $offers_in_category = $this->categoriesTable->find('id', $category_id);

    }

}

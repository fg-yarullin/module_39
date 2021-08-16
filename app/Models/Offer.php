<?php
namespace Models;
use Models\DatabaseTable;

class Offer {
    public $id;
    public $userid;
    public $offerdate;
    public $offertext;
    private $usersTable;
    private $user;
    private $offerCategoryTable;

    public function __construct(DatabaseTable $usersTable, DatabaseTable $offerCategoryTable) {
        $this->usersTable = $usersTable;
        $this->offerCategoryTable=$offerCategoryTable;
    }

    public function getUser() {
        if (empty($this->user)) {
            $this->user = $this->usersTable->findById($this->userid);
        }
        return $this->user;
    }

    public function addCategory($categoryId) {
        $offerCat = [
            'offerId' => $this->id,
            'categoryId' => $categoryId
        ];

        $this->offerCategoryTable->save($offerCat);
    }

    public function hasCategory($categoryId) {
        $offerCategories = $this->offerCategoryTable->find('offerId', $this->id);

        foreach ($offerCategories as $offerCategory) {
            if ($offerCategory->categoryId == $categoryId) {
                return true;
            }
        }
    }

    public function clearCategories() {
        $this->offerCategoryTable->deleteWhere('offerId', $this->id);
    }
}

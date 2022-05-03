<?php
namespace Models;
//use Models\DatabaseTable;

class CategoryOffers {
    public $offerId;
    public $categoryId;
    private $offerTable;

    public function __construct(DatabaseTable $offerTable) {
        $this->$offerTable = $offerTable;
    }

    public function getOffers() {
        if (empty($this->offerTable)) {
            $this->user = $this->usersTable->findById($this->userId);
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

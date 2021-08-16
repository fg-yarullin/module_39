<?php
namespace Models;
use Models\DatabaseTable;

class Category {
    public $id;
    public $name;
    private $offerTable;
    private $offerCategoriesTable;

    public function __construct(DatabaseTable $offerTable, DatabaseTable $offerCategoriesTable) {
        $this->offerTable = $offerTable;
        $this->offerCategoriesTable = $offerCategoriesTable;
    }

    public function getOffers($limit = null, $offset = null) {
        $offerCategories = $this->offerCategoriesTable->find('categoryId', $this->id, null, $limit, $offset);
        $offers = [];
        foreach ($offerCategories as $offerCategory) {
            $offer = $this->offerTable->findById($offerCategory->offerId);
            if ($offer) {
                $offers[] = $offer;
            }
            usort($offers, [$this, 'sortOffers']);
        }
        return $offers;
    }

    public function sortOffers($a, $b) {
        $aDate = new \DateTime($a->offerdate);
        $bDate = new \DateTime($b->offerdate);
        if ($aDate->getTimestamp() == $bDate->getTimestamp()) return 0;
        return $aDate->getTimestamp() > $bDate->getTimestamp() ? -1 : 1;
    }

    public function getOffersCount() {
        return $this->offerCategoriesTable->total('categoryId', $this->id);
    }
}

<?php
namespace Models;

class User {

    const EDIT_OFFERS = 1;
    const DELETE_OFFERS = 2;
    const LIST_CATEGORIES = 4;
    const EDIT_CATEGORIES = 8;
    const REMOVE_CATEGORIES = 16;
    const EDIT_USER_ACCESS = 32;

    public $id;
    public $name;
    public $email;
    public $password;
    public $role;
    private $offersTable;

    public function __construct(DatabaseTable $offersTable) {
        $this->offersTable = $offersTable;
    }

    public function getOffers() {
        return $this->offersTable->find('userId', $this->id);
    }

    public function addOffer($offer) {
        $offer['userId'] =$this->id;
        return $this->offersTable->save($offer);
    }

    public function hasPermission($permission) {
        return $this->permissions & $permission;
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }
}

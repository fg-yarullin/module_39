<?php
namespace Controllers;

use Models\DatabaseTable;

class CategoryController {
    private $categoriesTable;
//    private $offersTable;

    public function __construct(DatabaseTable $categoriesTable) {
        $this->categoriesTable = $categoriesTable;
//        $this->$offersTable = $offersTable;
    }

    public function list():array {
        $categories = $this->categoriesTable->findAll();
        $title = 'Offer Categories';
        $variables = ['categories' => $categories];
        return [
            'template' => 'categories.html.php',
            'title' => $title,
            'variables' => $variables
        ];
    }

//    public function getOffersInCategory():array {
//        if (isset($_GET['id'])) {
//            $category = $this->categoriesTable->findById($_GET['id']);
//            $offers = $this->offersTable->find()
//        }
//    }

    public function edit():array {
        if (isset($_GET['id'])) {
            $category = $this->categoriesTable->findById($_GET['id']);
        }

        $title = 'Edit Category';
        $variables = [
            'category' => $category ?? null,
        ];

        return [
            'title' => $title,
            'template' => 'editcategory.html.php',
            'variables' => $variables
        ];
    }

    public function saveEdit() {
        // $user = $this->authentication->getUser();
        $category = $_POST['category'];
        $this->categoriesTable->save($category);
        header('location: /category/list');
    }

    public function delete() {
        $this->categoriesTable->delete($_POST['id']);
        header('location: /category/list');
    }
}

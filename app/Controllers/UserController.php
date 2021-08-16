<?php
namespace Controllers;
use Models\DatabaseTable;

class UserController {
    private $usersTable;

    public function __construct(DatabaseTable $usersTable) {
        $this->usersTable = $usersTable;
    }

    public function list() {
        $users = $this->usersTable->findAll();

        $variables = ['users' => $users];

        return [
            'template' => 'userList.html.php',
            'title' => 'Users List',
            'variables' => $variables
        ];
    }

    public function permissions() {
        $user = $this->usersTable->findById($_GET['id']);
        $reflected = new \ReflectionClass('Models\User');
        $constants = $reflected->getConstants();
        $variables = ['user' => $user, 'permissions' => $constants];
        return [
            'template' => 'permissions.html.php',
            'title' => 'Edit Permissions',
            'variables' => $variables
        ];
    }

    public function savePermissons() {
        $user = [
            'id' => $_GET['id'],
            'permissions' => array_sum($_POST['permissions'] ?? [])
        ];
        // var_dump($user);exit();
        $this->usersTable->save($user);
        header('location: /user/list');
    }

    public function permissionError() {
        return [
            'template' => 'permissionError.html.php',
            'title' => 'Permission Error',
        ];
    }
}

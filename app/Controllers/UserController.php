<?php
namespace Controllers;
use Models\DatabaseTable;
use Controllers\Auth\Authentication;

class UserController {
    private $usersTable;
    private $authentication;

    public function __construct(DatabaseTable $usersTable) {
        $this->usersTable = $usersTable;
        $this->authentication = new Authentication($this->usersTable, 'email', 'password');
    }

    public function list():array {
        $users = $this->usersTable->findAll();

        $variables = ['users' => $users];

        return [
            'template' => 'userList.html.php',
            'title' => 'Users List',
            'variables' => $variables
        ];
    }

    public function permissions():array {
        $user = $this->usersTable->findById($_GET['id']);
        $reflected = new \ReflectionClass('Models\User');
        $constants = $reflected->getConstants();
        $variables = [
            'user' => $user,
            'permissions' => $constants
        ];
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

    public function permissionError():array {
        return [
            'template' => 'permissionError.html.php',
            'title' => 'Permission Error',
        ];
    }

    public function adminPage() {
        if ($this->authentication->getRole() === 'admin') {
            return [
                'template' => 'adminPage.html.php',
                'title' => 'Admin Page',
            ];
        }
        header('location: user/permissions/error');
    }
}

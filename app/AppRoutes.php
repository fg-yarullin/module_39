<?php
namespace App;
use Controllers\OfferController;
use Controllers\CategoryController;
use Models\DatabaseTable;
use Controllers\Auth\RegisterController;
use Controllers\Auth\Authentication;
use Controllers\Auth\Login;
use Controllers\UserController;
use Models\User;

class AppRoutes implements Routes{
    private $usersTable;
    private $offersTable;
    private $authentication;
    private $categoriesTable;
    private $offerCategoriesTable;

    public function __construct() {
        include __DIR__ . '/../config/DatabaseConnection.php';
        $this->offersTable = new DatabaseTable($pdo, 'offer', 'id', '\Models\Offer', [&$this->usersTable, &$this->offerCategoriesTable]);
        $this->usersTable = new DatabaseTable($pdo, 'user', 'id', '\Models\User', [&$this->offersTable]);
        $this->authentication = new Authentication($this->usersTable, 'email', 'password');
        $this->categoriesTable = new DatabaseTable($pdo, 'category', 'id', '\Models\Category', [&$this->offersTable, &$this->offerCategoriesTable]);
        $this->offerCategoriesTable = new DatabaseTable($pdo, 'offer_category', 'categoryId');
    }

    public function getRoutes(): array {
        $offerController = new OfferController($this->offersTable, $this->usersTable, $this->authentication, $this->categoriesTable);
        $registerController = new RegisterController($this->usersTable);
        $userController = new UserController($this->usersTable);
        $loginController = new Login($this->authentication);
        $categoryController = new CategoryController($this->categoriesTable);

        $routes = [
            'user/register' => [
                'POST' => [
                    'controller' => $registerController,
                    'action' => 'registerUser'
                ],

                'GET' => [
                    'controller' => $registerController,
                    'action' => 'registrationForm'
                ]
            ],

            'login' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'loginForm'
                ],
                'POST' => [
                    'controller' => $loginController,
                    'action' => 'proccessLogin'
                ],
            ],

            'login/success' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'success'
                ],
                'login' => true
            ],

            'login/error' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'error'
                ]
            ],

            'logout' => [
                'GET' => [
                    'controller' => $loginController,
                    'action' => 'logout'
                ]
            ],

            'user/success' => [
                'GET' => [
                    'controller' => $registerController,
                    'action' => 'success'
                ]
            ],

            'offer/edit' => [
                'POST' => [
                    'controller' => $offerController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $offerController,
                    'action' => 'edit'
                ],
                'login' => true
            ],

            'offer/delete' => [
                'POST' => [
                    'controller' => $offerController,
                    'action' => 'delete'
                ],
                'login' => true
            ],

            'offer/list' => [
                'GET' => [
                    'controller' => $offerController,
                    'action' => 'list'
                ]
            ],

            '' => [
                'GET' => [
                    'controller' => $offerController,
                    'action' => 'home'
                ]
            ],

            'category/edit' => [
                'POST' => [
                    'controller' => $categoryController,
                    'action' => 'saveEdit'
                ],
                'GET' => [
                    'controller' => $categoryController,
                    'action' => 'edit'
                ],
                'login' => true,
                'permissions' => User::EDIT_CATEGORIES
            ],

            'category/list' => [
                'GET' => [
                    'controller' => $categoryController,
                    'action' => 'list'
                ],
                'login' => true,
                'permissions' => User::LIST_CATEGORIES
            ],

            'category/delete' => [
                'POST' => [
                    'controller' => $categoryController,
                    'action' => 'delete'
                ],
                'login' => true,
                'permissions' => User::REMOVE_CATEGORIES
            ],

            'user/permissions' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'permissions'
                ],

                'POST' => [
                    'controller' => $userController,
                    'action' => 'savePermissons'
                ],
                'login' => true,
                'permissions' => User::EDIT_USER_ACCESS
            ],

            'user/list' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'list'
                ],
                'login' => true,
                'permissions' => User::EDIT_USER_ACCESS
            ],

            'user/permissions/error' => [
                'GET' => [
                    'controller' => $userController,
                    'action' => 'permissionError'
                ],
                'login' => true
            ],
        ];

        return $routes;
    }

    public function getAuthentication(): Authentication {
        return $this->authentication;
    }

    public function checkPermission($permission): bool {
        $user = $this->authentication->getUser();

        if ($user && $user->hasPermission($permission)) {
            return true;
        } else {
            return false;
        }
    }
}

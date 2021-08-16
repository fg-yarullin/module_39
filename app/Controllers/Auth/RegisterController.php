<?php
namespace Controllers\Auth;
use Models\DatabaseTable;

class RegisterController {
    private $usersTable;

    public function __construct(DatabaseTable $usersTable) {
        $this->usersTable = $usersTable;
    }

    public function registrationForm() {
        return [
            'template' => 'registration.html.php',
            'title' => 'Register an account',
            'variables' => []
        ];
    }

    public function registerUser() {
        $user = $_POST['user'];

        extract($this->validateUserData($user));

        if ($valid) {
            $user['email'] = strtolower($user['email']);
            $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
            $user['role'] = 'std-user';
            $this->usersTable->save($user);
            header('location: /user/success');
        } else {
            $data = $this->registrationForm();
            $data['variables']['errors'] = $errors;
            $data['variables']['user'] = $user;
            return $data;
        }
    }

    public function success() {
        return [
            'template' => 'registersuccess.html.php',
            'title' => 'Registraton is successful'
        ];
    }

    private function validateUserData($userData) {
        $valid = true;
        $errors = [];
        if (empty($userData['name'])) {
            $valid = false;
            $errors[] = 'Name cannot be blank';
        }
        if (empty($userData['email'])) {
            $valid = false;
            $errors[] = 'Email cannot be blank';
        } elseif (filter_var($userData['email'], FILTER_VALIDATE_EMAIL) == false) {
            $valid = false;
            $errors[] = 'Invalid email address';
        } else {
            if ($this->isUserExists($userData['email'])) {
                $valid = false;
                $errors[] = 'That email address is already registered';
            }
        }
        if (empty($userData['password'])) {
            $valid = false;
            $errors[] = 'Password cannot be blank';
        }
        if (empty($_POST['password_verify'])) {
            $valid = false;
            $errors[] = '"Retype Password" cannot be blank';
        }

        if ($_POST['password_verify'] != $userData['password']) {
            $valid = false;
            $errors[] = 'Password and "Retype Password" are not identical';
        }
        return [
            'valid' => $valid,
            'errors' => $errors
        ];
    }

    private function isUserExists($email) {
        $foundUser = $this->usersTable->find('email', strtolower($email));
        if (count($foundUser) > 0) {
            return true;
        }
    }
}

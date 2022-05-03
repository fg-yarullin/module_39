<?php
namespace Controllers\Auth;
//use Controllers\Auth\Authentication;

class Login {
    private $authentication;
    private $token = ''; // CSRF-token

    public function __construct(Authentication $authentication) {
        $this->authentication = $authentication;
    }

    public function loginForm():array {
        $this->generateToken();
        return [
            'template' => 'login.html.php',
            'title' => 'Log In',
            'variables' => [
                'token' => $this->token,
            ]
        ];
    }

    public function proccessLogin():array {
        if ($this->authentication->login($_POST['email'], $_POST['password'])) {
            if (session_status() !== PHP_SESSION_ACTIVE) session_start();
            header('location: /login/success');
        } else {
            $this->generateToken();
            return [
                'template' => 'login.html.php',
                'title' => 'Log In',
                'token' => $this->token,
                'variables' => [
                    'error' => 'Invalid usernanme/password.',
                    'token' => $this->token,
                ]
            ];
        }
    }

    public function success():array {
        return [
            'template' => 'loginsuccessful.html.php',
            'title' => 'Login successful'
        ];
    }

    public function error() {
        return [
            'template' => 'loginError.html.php',
            'title' => 'You are not logged in'
        ];
    }

    public function logout():array {
        // added later begin
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        // added later end
        unset($_SESSION);
        session_destroy();
        return [
            'template' => 'logout.html.php',
            'title' => 'You have been logged out'
        ];
    }

    public function generateToken() {
        $this->token = hash('gost-crypto', random_int(0,999999));
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION["token"] = $this->token;
    }
}

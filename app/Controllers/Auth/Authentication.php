<?php
namespace Controllers\Auth;

use Models\DatabaseTable;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Authentication {
    private $users;
    private $userNameColumn;
    private $passwordColumn;
    private $log;

    public function __construct(DatabaseTable $users, $userNameColumn, $passwordColumn) {
        // session_start();
        if(session_id() == '') session_start();
        $this->users = $users;
        $this->userNameColumn = $userNameColumn;
        $this->passwordColumn = $passwordColumn;
        $this->log = new Logger('access_log');
    }

    public function login($username, $password) {

        // added later begin

        if ($_POST['token'] != $_SESSION['token']) {
            $this->log->pushHandler(new StreamHandler('access_log.log', Logger::ALERT));
            $this->log->alert('tokens do not match');
            return false;
        }
        // added later end

        $user = $this->users->find($this->userNameColumn, strtolower($username));
        $passwordColumn = $this->passwordColumn;
        if (!empty($user) && password_verify($password, $user[0]->$passwordColumn)) {
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user[0]->$passwordColumn;
            return true;
        } else {
            $this->log->pushHandler(new StreamHandler('access_log.log', Logger::WARNING));
            $this->log->warning('Invalid username or password.');
            return false;
        }
    }

    public function isLoggedIn() {
        if (empty($_SESSION['username'])) {
            return false;
        }

        $user = $this->users->find($this->userNameColumn, strtolower($_SESSION['username']));

        if (!empty($user) && $user[0]->{$this->passwordColumn} === $_SESSION['password']) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser() {
        if ($this->isLoggedIn()) {
            $user = $this->users->find($this->userNameColumn, strtolower(($_SESSION['username'])));
            return $user[0];
        } else {
            $this->log->pushHandler(new StreamHandler('access_log.log', Logger::WARNING));
            $this->log->warning('Invalid username');
            return false;
        }
    }

    public function getRole() {
        $user = $this->getUser();
        return $user['role'];
    }
}

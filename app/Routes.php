<?php
namespace App;
use \Controllers\Auth\Authentication;

interface Routes {
    public function getRoutes(): array;
    public function getAuthentication(): Authentication;
    public function checkPermission($permission): bool;
}

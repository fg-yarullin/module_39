<?php
if (!isset($_COOKIE['visits'])) {
    $_COOKIE['visits'] = 0;
}

$visits = $_COOKIE['visits'] + 1;
setcookie('visits', $visits, time() + 3600 * 24 * 365);
if ($visits > 1) {
    echo "This is visit number $visits.";
} else {
    echo 'Welcome to our website! Click here for a tour!';
}


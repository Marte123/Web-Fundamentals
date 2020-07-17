<?php

include_once 'databasee.php';
include_once 'middleware.php';

function validCredentials($username, $password, $users) {
    foreach($users as $user) {
        if ($user->username == $username && $user->password == $password) {
            return true;
        }
    }
    return false;
}

refreshSessionTime();

?>
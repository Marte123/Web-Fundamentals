<?php

session_start();

function refreshSessionTime() {
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
    } else {
        $_SESSION['LAST_ACTIVITY'] = time();
    }
}

function checkLoggedIn($proceed=false) { 
    if(!isset($_SESSION["USER"])) {
        if ($proceed != true) {
            header("Location: \m\login.php");
            die();    
        } else {
            return false;
        }
    }
    return true;
}

function makeUnprotected() {
    if(isset($_SESSION["USER"])) {
        header("Location: \m\indexx.php");
        die();
    } 
}

function performLogout() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: \m\indexx.php");
} 
}
?>
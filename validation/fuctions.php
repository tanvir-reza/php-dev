<?php

function sanitizeInput($input) {
    $sanitizedInput = htmlspecialchars(strip_tags($input));
    return $sanitizedInput;
}

function validUser(){
    if(!isset($_COOKIE['CurrentUser'])){
        header('location: ./login.php');
    }
    
}
?>
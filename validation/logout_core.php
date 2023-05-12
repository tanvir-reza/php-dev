<?php
    if(!isset($_COOKIE['CurrentUser'])){
        header('location: ./login.php');
    }
    setcookie("CurrentUser", "", time() - 3600,"/");
    header('location: ../index.php');
?>

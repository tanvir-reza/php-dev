<?php
    if(isset($_COOKIE['CurrentUser'])){
        setcookie("CurrentUser", "", time() - 3600000,"/");
        header('location: ../index.php');
    }
    else{
        header('location: ./login.php');
    }
?>

<?php

if(isset($_GET['blog_id'])){
    $blog_id = $_GET['blog_id'];
    require_once('./config/db.php');
    $sql = "DELETE FROM `blog` WHERE `blog_id` = '$blog_id'";
    $result = mysqli_query($conn, $sql);
    if($result == true){
        header('location: ./profile.php?del_msg=Blog Deleted Successfully');
    }else{
        echo "Error";
    }
}
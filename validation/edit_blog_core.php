<?php
    require_once('../config/db.php');
     
    //         if(isset($_POST['blog_title']) || isset($_POST['description']) || isset($_FILES['up_blog_img'])){
    //             $blog_title = $_POST['blog_title'];
    //             $blog_id = $_POST['blog_no'];
    //             $description = $_POST['description'];
    //             $file_name = $_POST['old_img'];
    //             //  if(isset($_POST['up_blog_img'])){
    //             //     $file_name = $_FILES['up_blog_img']['name'];
    //             //     $file_tmp =$_FILES['up_blog_img']['tmp_name'];
    //             //     $file_type=$_FILES['up_blog_img']['type'];
    //             //     // $file_ext=strtolower(end(explode('.',$_FILES['blog_img']['name'])));
    //             //     $ext= pathinfo($file_name, PATHINFO_EXTENSION);
    //             //     $ext = strtolower($ext);
    //             //     if( $ext=="jpg" || $ext=="png" || $ext=="jpeg") {
    //             //         $img_unlink = "SELECT img FROM `blog` WHERE `blog_id` = '$blog_id'";
    //             //         $img_result = mysqli_query($conn, $img_unlink);
    //             //         $img_row = mysqli_fetch_array($img_result);
    //             //         $img_name = $img_row['img'];
    //             //         unlink("../uploads/".$img_name);
    //             //         $file_name = uniqid().".".$ext;
    //             //         $location = '../uploads/';
    //             //         move_uploaded_file($file_tmp,$location.$file_name);
    //             //     }
    //             //     else{
    //             //         $errors[]="File not allowed, please choose a JPG or PNG or JPEG file.";
    //             //         header('location: ./blog.php?err='.$errors.'');
    //             //     }
    //             //  }
    //             $sql_update = "UPDATE blog SET 'title'='$blog_title', 'description'='$description', 'img'='$file_name' WHERE 'blog_id'='$blog_id'";
    //             $result1 = mysqli_query($conn, $sql_update);
    //             if($result1 == true){
    //                 header('location: ../blog.php?success_update="Blog Updated Successfully"');
    //                 $conn->close();
    //             }
    //             else{
    //                 echo "Error";
    //                 $conn->close();
    //             }
    //         }
    // else{
    //     header('location: ./blog.php');
    // }
?>
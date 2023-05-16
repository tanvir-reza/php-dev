<?php
    require_once('../config/db.php');
    require_once('./fuctions.php');
     
            if(isset($_POST['blog_title']) || isset($_POST['description']) || isset($_FILES['up_blog_img'])){
                $blog_title = sanitizeInput($_POST['blog_title']);
                $description = sanitizeInput($_POST['description']);
                $blog_id = sanitizeInput($_POST['blog_no']);
                $file_name = sanitizeInput($_POST['old_img']);
                if(isset($_FILES['up_blog_img'])){
                    $new_file_name = $_FILES['up_blog_img']['name'];
                    $file_tmp =$_FILES['up_blog_img']['tmp_name'];
                    $file_type=$_FILES['up_blog_img']['type'];
                    // $file_ext=strtolower(end(explode('.',$_FILES['blog_img']['name'])));
                    $ext= pathinfo($new_file_name, PATHINFO_EXTENSION);
                    $ext = strtolower($ext);
                    if( $ext=="jpg" || $ext=="png" || $ext=="jpeg") {
                        $img_unlink = "SELECT img FROM `blog` WHERE `blog_id` = '$blog_id'";
                        $img_result = mysqli_query($conn, $img_unlink);
                        $img_row = mysqli_fetch_array($img_result);
                        $img_name = $img_row['img'];
                        unlink("../uploads/".$img_name);
                        $file_name = uniqid().".".$ext;
                        $location = '../uploads/';
                        move_uploaded_file($file_tmp,$location.$file_name);
                        echo "OKY";
                    }
                    else{
                        header('location: ../edit_blog.php?err="File not allowed, please choose a JPG or PNG or JPEG file."');
                    }
                 }
                $user_id = UserId($conn);
                $sql_update = "UPDATE `blog` SET `user_id`='$user_id', `title`='$blog_title',`description`='$description',`img`='$file_name' WHERE `blog_id` = '$blog_id'";
                $result1 = mysqli_query($conn, $sql_update);
                if($result1 == true){
                    header('location: ../profile.php?success_update="Blog Updated Successfully"');
                    $conn->close();
                }
                else{
                    echo "Error";
                    $conn->close();
                }
            }
            else{
             header('location: ./edit_blog.php?err="Please Fill All The Fields"');
            }
?>
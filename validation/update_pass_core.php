<?php
        if (!isset($_REQUEST['old_password']) && !isset($_REQUEST['new_password']) ) {
            header('location: ../profile.php');
        }
        else{
            require_once('../config/db.php');
            require_once('./fuctions.php');
            $old_password = sanitizeInput($_POST['old_password']);
            $new_password = sanitizeInput($_POST['new_password']);
            $CurrentUser = $_COOKIE['CurrentUser']; 
            $userPass = md5(sha1($old_password));
            if(isStrongPassword($new_password) == true){
                $newPass = md5(sha1($new_password));
            $sql = "SELECT * FROM user WHERE auth_token='$CurrentUser' LIMIT 1";
            $result = mysqli_query($conn, $sql);
            if($result == true){
            while($getRow = mysqli_fetch_array($result)){
                if($getRow['password'] == $userPass){
                    $authUpdate = md5(sha1($newPass));
                    $sql = "UPDATE user SET `password`='$newPass' , auth_token= '$authUpdate' WHERE auth_token='$CurrentUser'";
                        $result1 = mysqli_query($conn, $sql);
                        if($result1 == true){
                            $conn->close();
                            header('location: ./logout_core.php');
                        }else{
                            header('location: ../update.php?e_msg=error1');
                            $conn->close();
                        }
                }
                else{
                    header('location: ../update_pass.php?old_pass=wrong');
                    $conn->close();
                }

                
            }}
        }

        else{
            header('location: ../update_pass.php?e_msg_pass=error1');
        }
            
    }
    ?>
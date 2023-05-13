<?php
        if (!isset($_REQUEST['old_password']) && !isset($_REQUEST['new_password']) ) {
            header('location: ../profile.php');
        }
        else{
            require_once('../config/db.php');
           function sanitizeInput($input) {
                        $sanitizedInput = htmlspecialchars(strip_tags($input));
                        return $sanitizedInput;
            }
            $old_password = sanitizeInput($_POST['old_password']);
            $new_password = sanitizeInput($_POST['new_password']);
            $CurrentUser = $_COOKIE['CurrentUser']; 
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $userPass = md5(sha1($old_password));
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

                
            }
        }
    }
        // if(isset($_POST['username']) && isset($_POST['password'])){
        //     $username = sanitizeInput($_POST['username']);
        //     $password = sanitizeInput($_POST['password']);
            
        //     $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        //     if ($conn->connect_error) {
        //         die("Connection failed: " . $conn->connect_error);
        //     }
        //     $sql = "SELECT * FROM user WHERE username='$username' OR email='$username'";
        //     $result = mysqli_query($conn, $sql);
        //     $user = mysqli_fetch_assoc($result);
        //     if($user){
        //          $password = md5(sha1($password));
        //          $auth = md5(sha1($password));
        //         if($password == $user['password']){
        //             setcookie("CurrentUser", $auth, time() + (86400 * 30),"/");
        //             // $_SESSION['username'] = $user['username'];
        //             // $_SESSION['email'] = $user['email'];
        //             // $_SESSION['id'] = $user['id'];
        //             header('location: ../profile.php');
        //         }else{
        //             header('location: ../login.php?e_msg=error1');
        //             $conn->close();
        //         }
        //     }else{
        //         header('location: ../login.php?e_msg=error1');
        //         $conn->close();
        //     }

        // }
    ?>
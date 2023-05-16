<?php
        if (!isset($_REQUEST['username']) && !isset($_REQUEST['password'])) {
            header('location: ../login.php');
        }
        require_once('../config/db.php');
        require_once('./fuctions.php');   
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = sanitizeInput($_POST['username']);
            $password = sanitizeInput($_POST['password']);
            $sql = "SELECT * FROM user WHERE username='$username' OR email='$username'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);
            if($user){
                 $password = md5(sha1($password));
                 $auth = md5(sha1($password));
                if($password == $user['password']){
                    setcookie("CurrentUser", $auth, time() + (86400 * 30),"/");
                    // $_SESSION['username'] = $user['username'];
                    // $_SESSION['email'] = $user['email'];
                    // $_SESSION['id'] = $user['id'];
                    header('location: ../profile.php');
                }else{
                    header('location: ../login.php?e_msg=error1');
                    $conn->close();
                }
            }else{
                header('location: ../login.php?e_msg=error1');
                $conn->close();
            }

        }
    ?>
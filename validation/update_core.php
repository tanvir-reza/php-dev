<?php
        if (!isset($_REQUEST['username']) && !isset($_REQUEST['email']) && !isset($_REQUEST['bio'])) {
            header('location: ../login.php');
        }
        else{
            require_once('../config/db.php');
           function sanitizeInput($input) {
                        $sanitizedInput = htmlspecialchars(strip_tags($input));
                        return $sanitizedInput;
            }
            $username = sanitizeInput($_POST['username']);
            $email = sanitizeInput($_POST['email']);
            $bio = sanitizeInput($_POST['bio']);
            $CurrentUser = $_COOKIE['CurrentUser']; 
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "UPDATE user SET Username='$username', email='$email', bio='$bio' WHERE auth_token='$CurrentUser'";
            $result = mysqli_query($conn, $sql);
            if($result == true){
                $conn->close();
                header('location: ../profile.php?s_msg_update=success');
            }else{
                header('location: ../update.php?e_msg=error1');
                $conn->close();
            }

        }
    ?>
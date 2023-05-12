<?php
        if (!isset($_REQUEST['username']) && !isset($_REQUEST['password'])) {
            header('location: ../login.php?');
        }
        require_once('../config/db.php');
           function sanitizeInput($input) {
                        $sanitizedInput = htmlspecialchars(strip_tags($input));
                        return $sanitizedInput;
            }
        if(isset($_POST['username']) && isset($_POST['password'])){
            $username = sanitizeInput($_POST['username']);
            $password = sanitizeInput($_POST['password']);
            
            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM user WHERE username='$username' OR email='$username'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);
            if($user){
                $password1 = $password = md5(sha1($password));
                if($password1 == $user['password']){
                    setcookie("CurrentUser", $username, time() + (86400 * 30),"/");
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
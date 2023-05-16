<?php
        require_once('../config/db.php');
        require_once('./fuctions.php');
        if($_POST['username'] && $_POST['email'] && $_POST['password']){
            $username = sanitizeInput($_POST['username']);
            $email = sanitizeInput($_POST['email']);
            $password_user = sanitizeInput($_POST['password']);
            if(isStrongPassword('$password_user') == true){
                $password = $password_user;
                $password = md5(sha1($password));
                $sql_uniq = "SELECT * FROM `user` WHERE `username` = ? OR `email` = ? ";
                $stmt = $conn->prepare($sql_uniq);
                $stmt->bind_param("ss", $username, $email);
                $stmt->execute();
                $result_uniq = $stmt->get_result();
                if(mysqli_num_rows($result_uniq) > 0){
                    header('location: ../signup.php?e_msg=error1');
                    $stmt->close();
                    $conn->close();
                }
                else{
                    $stmt->close();
                    $authToken = md5(sha1($password));
                    echo $authToken;
                    $sql = "INSERT INTO `user` (`username`, `email`, `password` , `auth_token`) VALUES (?, ?, ?, ?)";
                    $stmt1 = $conn->prepare($sql);
                    $stmt1->bind_param("ssss", $username, $email, $password ,$authToken);
                    $result = $stmt1->execute();
                    if($result){
                        header('location: ../login.php?msg=success');
                    }else{
                        header('location: ../signup.php?e_msg=error2');
                    }
                }
                $stmt1->close();
                $conn->close();
            }
            else{
                header('location: ../signup.php?e_msg_password=error3');
            }
        }
        else{
            header('location: ../signup.php?');
        }
    ?>

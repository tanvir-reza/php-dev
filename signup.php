<?php require_once('./header.php') ?>
<?php require_once('./navbar.php') ?>

<?php 
    if(isset($_SESSION['username'])){
        header('location: ./index.php');
    }
?>

<div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto login-container">
                <div class="card login-card">
                    <div class="card-header login-card-header">
                        <h3 class="text-center">SignUp</h3>
                    </div>
                    <div class="card-body login-card-body">
                        <form action="./signup.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Enter Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Enter Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Enter Password <i class="fa fa-question-circle"></i></label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
        
                                <div class="text-center me-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        require_once('./config/db.php');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            function sanitizeInput($input) {
                        $sanitizedInput = htmlspecialchars(strip_tags($input));
                        return $sanitizedInput;
            }

            $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $username = sanitizeInput($_POST['username']);
            $email = sanitizeInput($_POST['email']);
            $password = sanitizeInput($_POST['password']);
            $password = md5(sha1($password));
            $sql_uniq = "SELECT * FROM `user` WHERE `username` = ? OR `email` = ? ";
            $stmt = $conn->prepare($sql_uniq);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result_uniq = $stmt->get_result();
            if(mysqli_num_rows($result_uniq) > 0){
                echo "<script>alert('User Already Exists !!')</script>";
                $stmt->close();
                $conn->close();
            }
            else{
                $stmt->close();
                $sql = "INSERT INTO `user` (`username`, `email`, `password`) VALUES (?, ?, ?)";
                $stmt1 = $conn->prepare($sql);
                $stmt1->bind_param("sss", $username, $email, $password);
                $result = $stmt1->execute();
                if($result){
                    header('location: ./login.php?msg=success');
                }else{
                    echo "<script>alert('User Not Created Successfully !!')</script>";
                }
            }

            $stmt1->close();
            $conn->close();
            
            
        }
    ?>



<?php require_once('./footer.php') ?>
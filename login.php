<?php require_once('./header.php') ?>
<?php require_once('./navbar.php') ?>

<?php
 if(isset($_SESSION['username'])){
     header('location: ./index.php');
 }
?>

<?php
 if(isset($_GET['msg'])){
     echo "<div class='alert alert-success alert-dismissible fade show w-50 container' role='alert'>
        <strong>User Registered Successfully !!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
 }


?>
<div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto login-container">
                <div class="card login-card">
                    <div class="card-header login-card-header">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body login-card-body">
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username / Email</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="d-flex">
                                <div class="text-center me-auto">
                                    <button type="submit" class="btn btn-primary">LogIn</button>
                                </div>
                                <div class="text-center">
                                    <a class="btn btn-warning" href="./signup.php"> SignUp</a>
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
                if(password_verify($password, $user['password'])){
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['id'] = $user['id'];
                    header('location: ./index.php');
                }else{
                    echo "<div class='alert alert-danger alert-dismissible fade show w-50 container' role='alert'>
                    <strong>Invalid Credentials !!</strong> 
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }
            }else{
                echo "<div class='alert alert-danger alert-dismissible fade show w-50 container' role='alert'>
                <strong>Invalid Credentials !!</strong> 
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }





<?php require_once('./footer.php') ?>
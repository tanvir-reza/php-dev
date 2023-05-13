<?php require_once('./header.php') ?>
<?php require_once('./navbar.php') ?>

<?php
 if(isset($_GET['e_msg'])){
     echo "<div class='alert alert-danger alert-dismissible fade show w-50 container' role='alert'>
        <strong>Update Not SuccessFully Done !!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
 }
 if(isset($_GET['old_pass'])){
     echo "<div class='alert alert-danger alert-dismissible fade show w-50 container' role='alert'>
        <strong>Old Password Not Correct !!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
 }
 

 ?>


<?php 
    if(!isset($_COOKIE['CurrentUser'])){
        header('location: ./login.php');
    }
    else{
        $CurrentUser = $_COOKIE['CurrentUser'];
        $username = "" ;
        $email = "" ;
        require_once('./config/db.php');
        // $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $sql = "SELECT * FROM user WHERE auth_token='$CurrentUser'";
        $result = mysqli_query($conn, $sql);
        if($result == true){
            while($getRow = mysqli_fetch_array($result)){ ?>
                <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto login-container">
                <div class="card login-card">
                    <div class="card-header login-card-header">
                        <h3 class="text-center">Password Update</h3>
                    </div>
                    <div class="card-body login-card-body">
                        <form action="./validation/update_pass_core.php" method="POST">
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Enter Old Password</label>
                                <input type="password" class="form-control" id="old_password" name="old_password" >
                            </div>
                            <div class="mb-3">
                                <label for="new_password" class="form-label">Enter New Password</label>
                                <input type="password"  class="form-control" id="new_password" name="new_password" >
                            </div>
                                <div class="text-center me-auto">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>  
            <?php 
            $conn->close();
        }
        }else{
            header('location: ./login.php');

        }
    }
?>



<?php require_once('./footer.php') ?>
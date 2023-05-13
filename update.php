<?php require_once('./header.php') ?>
<?php require_once('./navbar.php') ?>

<?php
 if(isset($_GET['e_msg'])){
     echo "<div class='alert alert-danger alert-dismissible fade show w-50 container' role='alert'>
        <strong>Update Not SuccessFully Done !!</strong> 
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
        $sql = "SELECT * FROM user WHERE auth_token='$CurrentUser' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        if($result == true){
            while($getRow = mysqli_fetch_array($result)){ ?>
                <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto login-container">
                <div class="card login-card">
                    <div class="card-header login-card-header">
                        <h3 class="text-center">UPDATE INFO</h3>
                    </div>
                    <div class="card-body login-card-body">
                        <form action="./validation/update_core.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Enter Username</label>
                                <input type="text" value='<?php echo $getRow['Username'];?>' class="form-control" id="username" name="username" >
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Enter Email</label>
                                <input type="email" value='<?php echo $getRow['email']; ?>' class="form-control" id="email" name="email" >
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Enter BIO</label>
                                <textarea class="form-control" id="bio" name="bio" rows="3" ><?php echo $getRow['bio']; ?></textarea>
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
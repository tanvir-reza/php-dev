<?php require_once('./header.php') ?>
<?php require_once('./navbar.php') ?>


<?php
 if(isset($_GET['s_msg_update'])){
     echo "<div class='alert alert-success alert-dismissible fade show w-50 container' role='alert'>
        <strong>Update Successfully !!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
 }

  if(isset($_GET['p_msg_update'])){
     echo "<div class='alert alert-success alert-dismissible fade show w-50 container' role='alert'>
        <strong>Password Update Successfully !!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
 }

 ?>

<div class="container text-center">
    <h1 style="color: #d9efff" class="mt-3">Profile</h1>
</div>



<?php
    if(!isset($_COOKIE['CurrentUser'])){
        header('location: ./login.php');
    }
    else{
        $CurrentUser = $_COOKIE['CurrentUser'];
        $username = "" ;
        $email = "" ;
        $bio = "";
        require_once('./config/db.php');
        // $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $sql = "SELECT * FROM user WHERE auth_token='$CurrentUser'";
        $result = mysqli_query($conn, $sql);
        if($result == true){
            while($getRow = mysqli_fetch_array($result)){
                $username = $getRow['Username'];
                $email = $getRow['email'];
                $bio = $getRow['bio'];

                
            }
            ?>
            <div class="container card w-50">
                <div class="card-body text-center">
                    <h1> <?php echo strtoupper($username); ?></h1>
                    <h4> <?php echo $email; ?></h4>
                    <p> <?php echo $bio; ?></p>
                    <a class="btn btn-warning mt-5" href="./update.php">UPDATE INFO</a>
                    <a class="btn btn-danger mt-5" href="./update_pass.php">UPDATE PASSWORD</a>

            </div>

            <?php
            $conn->close();
        }else{
            header('location: ./login.php');

        }
    }

?>





<?php require_once('./footer.php') ?>
    
    



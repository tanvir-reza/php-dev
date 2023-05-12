<?php require_once('./header.php') ?>
<?php require_once('./navbar.php') ?>

<?php
    if(!isset($_COOKIE['CurrentUser'])){
        header('location: ./login.php');
    }
    else{
        $CurrentUser = $_COOKIE['CurrentUser'];
        require_once('./config/db.php');
        // $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $sql = "SELECT * FROM user WHERE auth_token='$CurrentUser'";
        $result = mysqli_query($conn, $sql);
        if($result == true){
            while($getRow = mysqli_fetch_array($result)){
                echo $getRow['username'];
                $email = $getRow['email'];
                $id = $getRow['id'];


                // echo "<div class='container text-center mt-5'>";
                // echo "<h1 style='color: #d9efff' class='mt-3'>Welcome ".$username."</h1>";
                // echo "<h3 style='color: #d9efff' class='mt-3'>Your Email is ".$email."</h3>";
                // echo "<h3 style='color: #d9efff' class='mt-3'>Your Id is ".$id."</h3>";
                // echo "</div>";
            }
            echo "</div>";
        }else{
            header('location: ./login.php');

        }
    }

?>


<div class="container text-center">
    <h1 style="color: #d9efff" class="mt-3">Profile</h1>
</div>


<?php require_once('./footer.php') ?>
    
    



<?php require_once('./partials/header.php') ?>
<?php require_once('./partials/navbar.php') ?>

<?php
require_once('./validation/fuctions.php');
validUser();
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
 if(isset($_GET['success_update'])){
     echo "<div class='alert alert-success alert-dismissible fade show w-50 container' role='alert'>
        <strong>Blog Updated Successfully !!!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
 } if(isset($_GET['del_msg'])){
     echo "<div class='alert alert-success alert-dismissible fade show w-50 container' role='alert'>
        <strong>Blog Delete Successfully !!!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
 }

 ?>

<div class="container text-center">
    <h1 style="color: #d9efff" class="mt-3">User Profile</h1>
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
            }
            ?>
            <div class="container card ">
                <div class="card-body text-center">
                    <h1> <?php echo strtoupper($username); ?></h1>
                    <a class="btn btn-warning mt-1" href="./update.php">UPDATE INFO</a>
                    <a class="btn btn-danger mt-1" href="./update_pass.php">UPDATE PASSWORD</a>
            </div>
            <div class="container">
                
                <table class="table table-dark table-hover ">
                    <tr>
                        <th>Blog Title</th>
                        <th>Blog Description</th>
                        <th>Blog Image</th>
                        <th>Blog Date</th>
                        <th>Blog Action</th>
                    </tr>
                    <?php
                        $user_cookie = $_COOKIE['CurrentUser'];
                        $user_sql = "SELECT id FROM `user` WHERE `auth_token` = '$user_cookie'";
                        $user_result = mysqli_query($conn, $user_sql);
                        $user_row = mysqli_fetch_assoc($user_result);
                        $user_id = $user_row['id'];
                        $sql = "SELECT * FROM blog WHERE user_id='$user_id'";
                        $result = mysqli_query($conn, $sql);
                        if($result == true){
                            while($getRow = mysqli_fetch_array($result)){
                                $blog_id = $getRow['blog_id'];
                                $blog_title = $getRow['title'];
                                $blog_desc = $getRow['description'];
                                $blog_img = $getRow['img'];
                                $blog_date = $getRow['created_at'];
                                ?>
                                <tr>
                                    <td><?php echo $blog_title; ?></td>
                                    <td><?php echo $blog_desc; ?></td>
                                    <td><img src="./uploads/<?php echo $blog_img; ?>" width="100px" height="100px" alt=""></td>
                                    <td><?php echo $blog_date; ?></td>
                                    <td>
                                        <a class="btn btn-warning" href="./edit_blog.php?blog_id=<?php echo $blog_id; ?>">UPDATE</a>
                                        <a class="btn btn-danger" href="./delete_blog.php?blog_id=.<?php echo $blog_id; ?>">DELETE</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </div>

            <?php
            $conn->close();
        }else{
            header('location: ./login.php');

        }
    }

?>





<?php require_once('./partials/footer.php') ?>

    
    



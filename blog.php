<?php require_once('./partials/header.php') ?>
<?php require_once('./partials/navbar.php') ?>

<?php
require_once('./validation/fuctions.php');
validUser();

 if(isset($_GET['err'])){
     echo "<div class='alert alert-danger alert-dismissible fade show w-50 container' role='alert'>
        <strong>File not allowed, please choose a JPG or PNG or JPEG file.</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
 }
 if(isset($_GET['success'])){
     echo "<div class='alert alert-success alert-dismissible fade show w-50 container' role='alert'>
        <strong>Blog Created Successfully !!!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
 }
 
?>


<div class="container text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto login-container">
                <div class="card login-card">
                    <div class="card-header login-card-header">
                        <h3 class="text-center">Create Blog</h3>
                    </div>
                    <div class="card-body login-card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="blog_title" class="form-label">Title</label>

                                <input type="text" class="form-control" id="blog_title" name="blog_title" required placeholder = "Enter Blog Title">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" required placeholder = "Enter Blog Description">
                            </div>
                            <div class="mb-3">
                                <label for="blog_img" class="form-label">IMG</label>
                                <input type="file" class="form-control" id="blog_img" name="blog_img" required>
                            </div>
                            
                                <div class="text-center me-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once('./config/db.php');

if(isset($_POST['blog_title']) && isset($_POST['description']) && isset($_FILES['blog_img'])){
    $errors= array();
    $blog_title = sanitizeInput($_POST['blog_title']);
    $description = sanitizeInput($_POST['description']);
    $file_name = $_FILES['blog_img']['name'];
    $file_tmp =$_FILES['blog_img']['tmp_name'];
    $file_type=$_FILES['blog_img']['type'];
    // $file_ext=strtolower(end(explode('.',$_FILES['blog_img']['name'])));
    $ext= pathinfo($file_name, PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    if( $ext=="jpg" || $ext=="png" || $ext=="jpeg") {
        
        $file_name = uniqid().".".$ext;
        $location = 'uploads/';
        move_uploaded_file($file_tmp,$location.$file_name);
    }
    else{
        $errors[]="File not allowed, please choose a JPG or PNG or JPEG file.";
        header('location: ./blog.php?err='.$errors.'');
    }
    $user_cookie = $_COOKIE['CurrentUser'];
    $user_sql = "SELECT id FROM `user` WHERE `auth_token` = '$user_cookie'";
    $user_result = mysqli_query($conn, $user_sql);
    $user_row = mysqli_fetch_assoc($user_result);
    $user_id = $user_row['id'];
    $sql = "INSERT INTO `blog` (`title`, `description`, `img`, `user_id`) VALUES ('$blog_title', '$description', '$file_name', '$user_id')";
    $result = mysqli_query($conn, $sql);
    if($result){
        header('location: ./blog.php?success="Blog Created Successfully"');
        $conn->close();
    }
    else{
        echo "Something went wrong";
        $conn->close();
    }
}
?>

<?php require_once('./partials/footer.php') ?>
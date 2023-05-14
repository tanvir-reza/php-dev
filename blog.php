<?php require_once('./header.php') ?>
<?php require_once('./navbar.php') ?>

<?php
require_once('./validation/fuctions.php');
validUser();
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
                                <input type="text" class="form-control" id="blog_title" name="blog_title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
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
    $blog_title = $_POST['blog_title'];
    $description = $_POST['description'];
    $blog_img = $_POST['blog_img'];
    $file_name = $_FILES['blog_img']['name'];
    $file_tmp =$_FILES['blog_img']['tmp_name'];
    $file_type=$_FILES['blog_img']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['blog_img']['name'])));
    $extensions= array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if(empty($errors)==true){
        $file_name = uniqid().".".$file_ext;
        move_uploaded_file($file_tmp,"./upload".$file_name);
        header('location: ./blog.php?msg=success');
    }else{
        header('location: ./blog.php?err='.implode(",",$errors).'');
    }
    $user_id = $_COOKIE['CurrentUser'];
    $sql = "INSERT INTO `blog` (`title`, `description`, `img`, `user_id`) VALUES ('$blog_title', '$description', '$blog_img', '$user_id')";
    $result = mysqli_query($conn, $sql);
    if($result){
        header('location: ./index.php');
    }
    else{
        echo "Something went wrong";
    }
}

?>




<?php require_once('./footer.php') ?>
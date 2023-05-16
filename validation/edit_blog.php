<?php require_once('../header.php') ?>
<?php require_once('../navbar.php') ?>

<?php
require_once('../validation/fuctions.php');
validUser();
require_once('../config/db.php');

if(!isset($_GET['blog_id'])){
    header('location: ./blog.php');
}
else{
    $blog_id = $_GET['blog_id'];
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    $sql = "SELECT * FROM blog WHERE blog_id='$blog_id'";
    $result = mysqli_query($conn, $sql);
    if($result == true){
        while($getRow = mysqli_fetch_array($result)){
            $blog_no = $getRow['blog_id'];
            $blog_title = $getRow['title'];
            $blog_description = $getRow['description'];
            $blog_image = $getRow['img'];
            ?>
            <div class="container text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto login-container">
                <div class="card login-card">
                    <div class="card-header login-card-header">
                        <h3 class="text-center">Update Blog</h3>
                    </div>
                    <div class="card-body login-card-body">
                        <form action="./edit_blog_core.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="blog_title" class="form-label">Title</label>
                                <input type="hidden" name="blog_no" value="<?php echo $blog_no ?>">
                                <input type="text" value= "<?php echo $blog_title ?>" class="form-control" id="blog_title" name="blog_title" >
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" value= "<?php echo $blog_description ?>" class="form-control" id="description" name="description" >
                            </div>
                            <div class="mb-3">
                                <img src="../uploads/<?php echo $blog_image ?>" width="50px" height="50px">
                                <label for="up_blog_img" class="form-label">IMG</label>
                                <input type="hidden" name="old_img" value="<?php echo $blog_image ?>">
                                <input type="file" class="form-control" id="up_blog_img" name="up_blog_img" >
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


            <?php  } } }?>



<?php require_once('../footer.php') ?>
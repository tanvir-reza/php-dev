<?php require_once('./partials/header.php') ?>
<?php 
require_once('./partials/navbar.php');
require_once('./config/db.php');
require_once('./validation/fuctions.php');

?>

<div class="container text-center">
    <h1 style="color: #d9efff" class="mt-3">PHP DeveLoper Task</h1>
    <?php
    if(!isset($_COOKIE['CurrentUser'])){
       echo '<a class="btn btn-primary me-2" href="./login.php">Login</a>
        <a class="btn btn-warning me-2" href="./login.php">SignUp</a>';
    }
    ?>
    <?php
    $sql = "SELECT * FROM blog inner join user on blog.user_id = user.id";
    $result = mysqli_query($conn, $sql);
    if($result == true){
        while($getRow = mysqli_fetch_array($result)){
            $blog_id = $getRow['blog_id'];
            $blog_title = $getRow['title'];
            $blog_desc = $getRow['description'];
            $blog_img = $getRow['img'];
            $blog_author = $getRow['Username'];
            $blog_date = $getRow['created_at'];
            ?>
            <div class="card" style="width: 14rem; align-items: center !important;">
            <img class="card-img-top w-75 img-thumbnail" src="./uploads/<?php echo $blog_img ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $blog_title ?></h5>
                <p class="card-text"><?php echo $blog_desc ?></p>
                <br>
                <h7 class="card-title"><strong>Author : <?php echo $blog_author ?></strong> </h7>
                <p class="card-text">Created : <?php echo date('d M Y',strtotime($blog_date)); ?></p>
            </div>
            </div>
            <?php
        }
    }
    ?>
</div>

<?php require_once('./partials/footer.php') ?>
    
    



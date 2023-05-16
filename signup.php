<?php require_once('./partials/header.php') ?>
<?php require_once('./partials/navbar.php') ?>

<div style="display:none" id="strPass" class='alert alert-info alert-dismissible fade show w-50 container ' role='alert'>
        <strong>
            <pre>
                1. Password At least 8 characters long.
                2. Password must contain at least one uppercase letter.
                3. Password must contain at least one lowercase letter.
                4. Password must contain at least one number.
                5. Password must contain at least one special character.
            </pre>
        </strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>

<?php 
    if(isset($_SESSION['CurrentUser'])){
        header('location: ./index.php');
    }
    if(isset($_GET['e_msg_password']))
        {
        echo "<div class='alert alert-danger alert-dismissible fade show w-50 container' role='alert'>
        <strong>Please Choose Strong Password !!</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    if(isset($_REQUEST['e_msg'])){
        if($_GET['e_msg'] == 'error1')
        {
        echo "<div class='alert alert-danger alert-dismissible fade show w-50 container' role='alert'>
        <strong>User Already Exist !!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
        if($_GET['e_msg'] == 'error2')
        {
        echo "<div class='alert alert-danger alert-dismissible fade show w-50 container' role='alert'>
        <strong>User Create Not Success !!</strong> 
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
        
    }
?>

<div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto login-container">
                <div class="card login-card">
                    <div class="card-header login-card-header">
                        <h3 class="text-center">SignUp</h3>
                    </div>
                    <div class="card-body login-card-body">
                        <form action="./validation/signup_core.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Enter Username</label>
                                <input type="text" class="form-control" id="username" name="username" required placeholder = "Enter username">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Enter Email</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder = "Enter email">
                            </div>
                            <div onmouseover="own()" class="mb-3">
                                <label for="password" class="form-label">Enter Password <i class="fa fa-question-circle"></i></label>
                                <input type="password" class="form-control" id="password" name="password" required placeholder = "Enter Strong Password">
                            </div>
        
                                <div class="text-center me-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
            function own(){
                document.getElementById('strPass').style.display = "block";
            }
    </script>


<?php require_once('./partials/footer.php') ?>

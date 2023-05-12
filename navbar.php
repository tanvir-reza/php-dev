<!-- <div class="container"> -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="./index.php">PHP DEV</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php if(isset($_COOKIE['CurrentUser'])){
        echo  '<li class="nav-item">
          <a class="nav-link" href="./profile.php">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./validation/logout_core.php">Logout</a>
        </li>';
        }
        else{
          echo '
          <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup.php">SignUp</a>
        </li>';
        } 
        ?>
       
      </ul>
    </div>
  </div>
</nav>
    <!-- < -->
<?php 
function sanitizeInput($input) {
    $sanitizedInput = htmlspecialchars(strip_tags($input));
    return $sanitizedInput;
}

function validUser(){
    if(!isset($_COOKIE['CurrentUser'])){
        header('location: ./login.php');
    }
    
}
function userId($conn){
    $conn = $conn;
    $user_cookie = $_COOKIE['CurrentUser'];
    $user_sql = "SELECT id FROM `user` WHERE `auth_token` = '$user_cookie'";
    $user_result = mysqli_query($conn, $user_sql);
    $user_row = mysqli_fetch_assoc($user_result);
    $user_id = $user_row['id'];
    return $user_id;
}

function isStrongPassword($password) {
  if (strlen($password) < 6) {
    return false;
  }
//   if (!preg_match('@[A-Z]@', $password)) {
//     return false;
//   }

//   if (!preg_match('@[a-z]@', $password)) {
//     return false;
//   }

//   if (!preg_match('@[0-9]@', $password)) {
//     return false;
//   }

//   if (!preg_match('@[^\w]@', $password)) {
//     return false;
//   }

  return true;
}
?>
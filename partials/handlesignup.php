<?php
$showError = "FALSE";
if($_SERVER['REQUEST_METHOD']=='POST'){
include '_dbconnect.php';
$user_email= $_POST['signupemail'];
$pass= $_POST['signuppassword'];
$cpass= $_POST['signupcpassword'];

// check whether this email exists
$existsql= " select * from `users` where `user_email`= '$user_email' ";
$result= mysqli_query($conn,$existsql);
$numRows= mysqli_num_rows($result);
if($numRows>0)
{
   $showError="This email is already in use";
}
else{
    if($pass==$cpass){
     $hash=password_hash($pass, PASSWORD_DEFAULT);
     $sql="INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES('$user_email', '$hash', current_timestamp())";
     $result= mysqli_query($conn,$sql);
     if($result){
         $showAlert=true;
         header("location: /forum/index.php?signupsuccess=true");
         exit();
     }
    }
    else{
        $showError="Passwords do not match";
    }
    header("location: /forum/index.php?signupsuccess=false&error=$showError");
}
}
?>
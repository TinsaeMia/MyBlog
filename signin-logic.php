<?php
include('config/database.php');
//make sure the signin button was clicked
if(isset($_POST['submit']))
{
//get form data
$username_email=filter_var($_POST['username_email'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password=filter_var($_POST['password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if(!$username_email)
{
  $_SESSION['signin']="Username or Email required";
}
elseif(!$password)
{
  $_SESSION['signin']="Passwordrequired";
}
else{
  //fetch user from data base
  $fetch_user_query="SELECT * From users WHERE username='$username_email' OR email='$username_email'";
  $fetch_user_result=mysqli_query($connection,$fetch_user_query);
  if(mysqli_num_rows( $fetch_user_result)==1)
  {
    //we found a valid user or error methiod
    //convert the record to a associative array
    $user_record=mysqli_fetch_assoc($fetch_user_result);
    $db_password= $user_record['password'];//gets us the hashed password from db to compare fotm pass with db pass
    if(password_verify($password,$db_password))
    {
      //set session for access control.check if someone is logged in
      //to show user avatar and give access to dash board
      $_SESSION['user-id']=$user_record['id'];
      //check if the user is admin or not
      if($user_record['is_admin']==1){
        $_SESSION['user_is_admin']=true;
      }
      //log user in
      header('location: '.ROOT_URL . 'admin/');
      die();//added by me
    }
    else{
      $_SESSION['signin']="Please check your input";
    }

  }
  else{
    $_SESSION['signin']="User not found";
  }
}
//if there was any problem,redirect back to signin page wioth login detailes
if(isset( $_SESSION['signin']))
{
  $_SESSION['signin-data']=$_POST;
  header('location: '.ROOT_URL . 'signin.php');
  die();
}
}
else
{
  //bounce it back tosign in page
  header('location: '. ROOT_URL . 'signin.php');
  die();
}
?>

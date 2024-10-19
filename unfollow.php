<?php
require('C:/xampp/htdocs/blog/partials/header.php');
$id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
if(isset($_SESSION['user-id']))
{$uid=$_SESSION['user-id'];
  if(isset($_GET['id']) )
  { 
   
$updatecount="UPDATE user_followers SET follower_count= follower_count-1 WHERE user_id=$id;";
$ed=mysqli_query($connection,$updatecount);
$updatecount1="UPDATE user_followers SET following_count= following_count-1 WHERE user_id=$uid;";
$ed1=mysqli_query($connection,$updatecount1);


$ins1="DELETE FROM followed where following_user_id=$uid and followed_user_id=$id";
$exe1=mysqli_query($connection,$ins1);
header('location: '.ROOT_URL . 'userposts.php?id='.$id);
die();
}
else
{
  header('location: '.ROOT_URL . 'userposts.php?id='.$id);
die();
}
  }


else
{  $_SESSION['follow']='you have to sign-in or sign-up to unfollow a user';
  header('location: '.ROOT_URL . 'signin.php');
die();
}
?>
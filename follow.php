<?php
require('C:/xampp/htdocs/blog/partials/header.php');
$id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
if(isset($_SESSION['user-id']))
{$uid=$_SESSION['user-id'];
  $onc="SELECT * FROM followed where following_user_id=$uid and followed_user_id=$id ";
$o=mysqli_query($connection,$onc);
  if(isset($_GET['id']) && $uid!=$id)
  { 
    if (mysqli_num_rows($o)==0)

{
$updatecount="UPDATE user_followers SET follower_count= follower_count+1 WHERE user_id=$id;";
$ed=mysqli_query($connection,$updatecount);
$updatecount1="UPDATE user_followers SET 	following_count= following_count+1 WHERE user_id=$uid;";
$ed1=mysqli_query($connection,$updatecount1);


$ins1="INSERT INTO followed SET following=1,following_user_id=$uid,followed_user_id=$id";
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
  elseif(isset($_GET['id']) && $uid==$id)//so ppl dont follow themselfes 
  {
    header('location: '.ROOT_URL . 'userposts.php?id='.$id);
    die();
  }
else
{
  header('location: '.ROOT_URL . 'blog.php');
}}
else
{  $_SESSION['follow']='you have to sign-in or sign-up to follow a user';
  header('location: '.ROOT_URL . 'signin.php');
die();
}
?>
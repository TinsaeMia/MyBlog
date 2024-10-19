<?php

require('C:/xampp/htdocs/blog/admin/config/database.php');
$msg=$_POST['comment'];
if(isset($_SESSION['user-id']))
{  $user_id=$_SESSION['user-id'];
  if(isset($_GET['id']))
    {
      $post_id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  }

 if(isset($_POST['submit']))
{
  $query="INSERT INTO comments SET message='$msg',post_id=$post_id,user_id=$user_id";
$result=mysqli_query($connection,$query);
$com="SELECT * FROM comments WHERE post_id=$post_id and message='$msg' and user_id=$user_id";
$ex=mysqli_query($connection,$com);
 $comment=mysqli_fetch_assoc($ex);
$cid=$comment['comment_id'];
$query1="INSERT INTO votes SET Likes=0,post_id=$post_id,Dislikes=0,comment_id=$cid";
$result1=mysqli_query($connection,$query1);
}
header('location: '.ROOT_URL . 'post.php?id='.$post_id);
die();
}
else
{  $_SESSION['connection']='you have to   sign-in or sign-up to add a comment';
  header('location: '.ROOT_URL . 'signin.php');
die();
}
 


 ?>
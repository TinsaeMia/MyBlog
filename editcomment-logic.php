<?php
require('C:/xampp/htdocs/blog/partials/header.php');



if(isset($_POST['submit']))
{  $user_id=$_SESSION['user-id'];
  $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
 $cid=filter_var($_GET['cid'],FILTER_SANITIZE_NUMBER_INT);
  $msg=$_POST['comment'];
   $updatecomment="UPDATE comments SET message='$msg' where post_id=$id and comment_id=$cid";
   $exupdatecomment=mysqli_query($connection,$updatecomment);

   header('location: '.ROOT_URL . 'post.php?id='.$id);
   die();
    }
  



?> 
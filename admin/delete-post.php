<?php
require('config/database.php');

if(isset($_GET['id']))
{ 
  
  
  if(isset($_POST['submit']))
  {$id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  //fetch the post from db anddelete the thumbnail from the images post
  $query="SELECT * FROM posts WHERE id=$id";
  $result=mysqli_query($connection,$query);
  if(mysqli_num_rows($result)==1)//make sure only one record is fetched
  {$post=mysqli_fetch_assoc($result);
    $thumbnail_name=$post['thumbnail'];
    $thumbnail_path='../images/'.  $thumbnail_name;//path of img we want to delete
    if($thumbnail_path)//if we have the path
    {
      $delcom="DELETE FROM comments where post_id=$id ";
      $delvotes="DELETE FROM votes where post_id=$id ";
      $delvoted_comment="DELETE FROM voted_comment where post_id=$id";
      $delpost_votes="DELETE FROM post_votes where post_id=$id ";
       $delvoted_post="DELETE FROM voted_post where post_id=$id";
       $deletesaved="DELETE FROM saved_posts WHERE post_id=$id";
     
    
    
      $exdelvotes=mysqli_query($connection,$delvotes);
      $exdelvoted_comment=mysqli_query($connection,$delvoted_comment);
      $excom=mysqli_query($connection,$delcom);//delete comments
      $exdelpost_votes=mysqli_query($connection,$delpost_votes);
      $exdelvoted_post=mysqli_query($connection,$delvoted_post);
      $executesaved=mysqli_query($connection,$deletesaved);
     
      unlink($thumbnail_path);
      //delete post from post table
      $delete_post_query="DELETE FROM posts WHERE id=$id LIMIT 1";
      $delete_post_que=mysqli_query($connection,$delete_post_query);
    
  
    

      
      //have a success message
      if(!mysqli_errno($connection))
      {
        $_SESSION['delete-post-success']="Post is deleted successfully";
      }
    }
  }}
  else
  {
    $id1=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
header('location: '.ROOT_URL . 'admin/deletepostconfirm.php?id='.$id1);
die();
  }
}
header('location:' . ROOT_URL . 'admin/');
die();
?>
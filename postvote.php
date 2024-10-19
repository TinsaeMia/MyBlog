<?php
include('config/database.php');
if(isset($_SESSION['user-id'])){
if(isset($_GET['id']))
{$user_id=$_SESSION['user-id'];
  $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

 $once="SELECT * FROM voted_post where user=$user_id and post_id=$id and Likes=1";
 $on=mysqli_query($connection,$once);
 $once2="SELECT * FROM voted_post where user=$user_id and  post_id=$id and dislikes=1";
 $on2=mysqli_query($connection,$once2);
 $onc="SELECT * FROM voted_post where user=$user_id and post_id=$id ";
$o=mysqli_query($connection,$onc);
  if(isset($_POST['postlike']))
  {   
    if (mysqli_num_rows($o)==0 && mysqli_num_rows($on2)==0 )
    {
      $ins1="INSERT INTO voted_post SET Likes=1,dislikes=0,user=$user_id,post_id=$id;";
$exe1=mysqli_query($connection,$ins1);
$updet="UPDATE post_votes SET Likes = Likes+1/* , post_id=$id,comment_id=$cid */ WHERE post_id=$id  ;";
$execute=mysqli_query($connection,$updet);
header('location: '.ROOT_URL . 'post.php?id='.$id);
die();
    }
    else
    {
    if (mysqli_num_rows($on)==0 && mysqli_num_rows($on2)==0)
 { $updet1="UPDATE voted_post SET Likes = Likes+1/* , post_id=$id,comment_id=$cid */ WHERE user=$user_id and post_id=$id;";
    $execute1=mysqli_query($connection,$updet1);
   
   $updet="UPDATE post_votes SET Likes = Likes+1/* , post_id=$id,comment_id=$cid */ WHERE post_id=$id ;";
   $execute=mysqli_query($connection,$updet);
  
   }
   elseif(mysqli_num_rows($on2)==0 && mysqli_num_rows($on)!=0 )/* if user alredy liked  */ 
 { $updet1="UPDATE voted_post SET Likes = Likes-1/* , post_id=$id,comment_id=$cid */ WHERE user=$user_id and post_id=$id;";
    $execute1=mysqli_query($connection,$updet1);
   
   $updet="UPDATE post_votes SET Likes = Likes-1/* , post_id=$id,comment_id=$cid */ WHERE post_id=$id ;";
   $execute=mysqli_query($connection,$updet);
    
    header('location: '.ROOT_URL . 'post.php?id='.$id);
    die();
   }}
  }
  elseif(isset($_POST['postdislike']))
  {  if (mysqli_num_rows($o)==0 && mysqli_num_rows($on)==0)
     {     
       $ins2="INSERT INTO voted_post SET Likes=0,dislikes=1,user=$user_id,post_id=$id;";
      $exe2=mysqli_query($connection,$ins2);
 $updet2="UPDATE post_votes SET Dislike = Dislike+1/* , post_id=$id,comment_id=$cid  */WHERE post_id=$id;";
 $execute2=mysqli_query($connection,$updet2);
 header('location: '.ROOT_URL . 'post.php?id='.$id);
die();
     }
     else
     {
      if (mysqli_num_rows($on2)==0 && mysqli_num_rows($on)==0)//&& are so we cant like if we dislike and dislike if we like
      {
        $updet3="UPDATE voted_post SET dislikes = dislikes+1/* , post_id=$id,comment_id=$cid */ WHERE user=$user_id and post_id=$id; ";
          $execute3=mysqli_query($connection,$updet3);
         
         $updet4="UPDATE post_votes SET Dislike = Dislike+1/* , post_id=$id,comment_id=$cid */ WHERE post_id=$id ;";
         $execute4=mysqli_query($connection,$updet4);
        
      }
      elseif(mysqli_num_rows($on)==0 && mysqli_num_rows($on2)!=0 )/* if user alredy disliked  */ 
      { $updet5="UPDATE voted_post SET dislikes = dislikes-1/* , post_id=$id,comment_id=$cid */ WHERE user=$user_id and post_id=$id;";
        $execute5=mysqli_query($connection,$updet5);
       
       $updet6="UPDATE post_votes SET Dislike = Dislike-1/* , post_id=$id,comment_id=$cid */ WHERE post_id=$id ;";
       $execute=mysqli_query($connection,$updet6);
        header('location: '.ROOT_URL . 'post.php?id='.$id);
die();
      }
     }
  }
  elseif(isset($_POST['save']))
  {
    $save="INSERT INTO saved_posts SET post_id=$id,uid=$user_id";
    $saveresult=mysqli_query($connection,$save);
    $_SESSION['saved']="Added to chart";

  }
  elseif(isset($_POST['remove']))
  {
    $unsave="DELETE FROM saved_posts where post_id=$id and uid=$user_id";
    $unsaveresult=mysqli_query($connection,$unsave);
    $_SESSION['saved']="Removed from chart";
   
   
  }
  header('location: '.ROOT_URL . 'post.php?id='.$id);
die();
}}
else

  { $_SESSION['postlike']='you have to sign-in or sign-up to like or dislike  a post';
    header('location: '.ROOT_URL . 'signin.php');
  die();
  }

?>
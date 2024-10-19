<?php
include('config/database.php');
if(isset($_SESSION['user-id'])){
if(isset($_GET['id']))
{$user_id=$_SESSION['user-id'];
  $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
 $cid=filter_var($_GET['cid'],FILTER_SANITIZE_NUMBER_INT);
 $once="SELECT * FROM voted_comment where user=$user_id and comment_id=$cid and Likes=1";
 $on=mysqli_query($connection,$once);
 $once2="SELECT * FROM voted_comment where user=$user_id and comment_id=$cid and dislikes=1";
 $on2=mysqli_query($connection,$once2);
 $onc="SELECT * FROM voted_comment where user=$user_id and comment_id=$cid ";
$o=mysqli_query($connection,$onc);
  if(isset($_POST['likes']))
  {   
    if (mysqli_num_rows($o)==0)
    {
      $ins1="INSERT INTO voted_comment SET Likes=1,dislikes=0,user=$user_id,comment_id=$cid,post_id=$id;";
$exe1=mysqli_query($connection,$ins1);
$updet="UPDATE votes SET Likes = Likes+1/* , post_id=$id,comment_id=$cid */ WHERE post_id=$id  and comment_id=$cid;";
$execute=mysqli_query($connection,$updet);
header('location: '.ROOT_URL . 'post.php?id='.$id);
die();
    }
    else
    {
    if (mysqli_num_rows($on)==0)
   { $updet1="UPDATE voted_comment SET Likes = Likes+1/* , post_id=$id,comment_id=$cid */ WHERE user=$user_id and comment_id=$cid; ";
    $execute1=mysqli_query($connection,$updet1);
   
   $updet="UPDATE votes SET Likes = Likes+1/* , post_id=$id,comment_id=$cid */ WHERE post_id=$id  and comment_id=$cid;";
   $execute=mysqli_query($connection,$updet);
  
   }
   else
   {
    header('location: '.ROOT_URL . 'post.php?id='.$id);
    die();
   }}
  }
  elseif(isset($_POST['dislike']))
  {  if (mysqli_num_rows($o)==0)
     {     
       $ins2="INSERT INTO voted_comment SET Likes=0,dislikes=1,user=$user_id,comment_id=$cid,post_id=$id;";
      $exe2=mysqli_query($connection,$ins2);
 $updet2="UPDATE votes SET Dislikes = Dislikes+1/* , post_id=$id,comment_id=$cid  */WHERE post_id=$id and  comment_id=$cid;";
 $execute2=mysqli_query($connection,$updet2);
 header('location: '.ROOT_URL . 'post.php?id='.$id);
die();
     }
     else
     {
      if (mysqli_num_rows($on2)==0)
      {
        $updet3="UPDATE voted_comment SET dislikes = dislikes+1/* , post_id=$id,comment_id=$cid */ WHERE user=$user_id and comment_id=$cid; ";
          $execute3=mysqli_query($connection,$updet3);
         
         $updet4="UPDATE votes SET Dislikes = Dislikes+1/* , post_id=$id,comment_id=$cid */ WHERE post_id=$id  and comment_id=$cid;";
         $execute4=mysqli_query($connection,$updet4);
        
      }
      else
      {
        header('location: '.ROOT_URL . 'post.php?id='.$id);
die();
      }                                    
     }
  }
  elseif(isset($_POST['delete']))
  {
    $s="SELECT * FROM  comments where post_id=$id and comment_id=$cid";
    $r=mysqli_query($connection,$s);
    $ac=mysqli_fetch_assoc($r);
   $use =$ac['user_id'];
    if($user_id==$use) /*make sure the person thats deleting the comment is the same person who posted it */ 
  {  
 $del="DELETE FROM votes where post_id=$id and comment_id=$cid";
 $delcom="DELETE FROM comments where post_id=$id and comment_id=$cid";
 $delvot="DELETE FROM voted_comment where comment_id=$cid";
 $execute=mysqli_query($connection,$del);
 $execute3=mysqli_query($connection,$delvot);
  $execute2=mysqli_query($connection,$delcom);
   } 
  else
  {$_SESSION['editcomment']="you can't delete someone elses comment";
    header('location: '.ROOT_URL . 'post.php?id='.$id);
    die();
  }
  }
  elseif(isset($_POST['edit']))
  { $s="SELECT * FROM  comments where post_id=$id and comment_id=$cid";
    $r=mysqli_query($connection,$s);
    $ac=mysqli_fetch_assoc($r);
   $use =$ac['user_id'];
   if($user_id==$use)
    {header('location: '.ROOT_URL . 'editcomment.php?id='.$id.'&cid='.$cid);
    die();}
    else
    {
      $_SESSION['editcomment']="you can't edit someone elses comment";
      header('location: '.ROOT_URL . 'post.php?id='.$id);
      die();
    }
  }
  header('location: '.ROOT_URL . 'post.php?id='.$id);
die();
}}
else

  { $_SESSION['vote']='you have to sign-in or sign-up to like,dislike and edit a comment';
    header('location: '.ROOT_URL . 'signin.php');
  die();
  }

?>
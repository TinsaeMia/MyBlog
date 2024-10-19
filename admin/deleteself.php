<?php

include('C:/xampp/htdocs/blog/admin/partials/header.php');
//WE USE GET CUZ WE ARE GETTING ID FROM THE URL
  $user_id=$_SESSION['user-id'];
  $query="SELECT * FROM users WHERE id=$user_id";
  $result=mysqli_query($connection,$query);
  $user=mysqli_fetch_assoc($result);
 if(isset($_POST['submit']))
  {
    
    //delete users avatar
  $avatar_name=$user['avatar'];
  $avatar_path='../images/'.$avatar_name;
  //is the image exists in our folder delete it
  if($avatar_path)
  {
    unlink($avatar_path);
  }
   //delete all comments 
   $forcom="SELECT * FROM comments WHERE user_id=$user_id";
   $forcomresult=mysqli_query($connection,$forcom);
   while($forcomassoc=mysqli_fetch_assoc($forcomresult))
   {
    $vpid=$forcomassoc['post_id'];
    $vcid=$forcomassoc ['comment_id'];
    $delvotes="DELETE FROM votes where post_id=$vpid and comment_id=$vcid";
    $exvotes=mysqli_query($connection,$delvotes);
    
    
   }
   $delvotedcomment="DELETE FROM voted_comment where user=$user_id";
  $exvotedcomment=mysqli_query($connection,$delvotedcomment);
   $delcom="DELETE FROM comments where user_id =$user_id ";
  $excom=mysqli_query($connection,$delcom);
  $delpostvotes="DELETE FROM post_votes where user_id=$user_id";
  $expostvotes=mysqli_query($connection,$delpostvotes);
  $delvoted_post="DELETE FROM voted_post where user=$user_id";
  $exvoted_post=mysqli_query($connection,$delvoted_post);
  
  
  


  
  $thumbnails_query="SELECT thumbnail FROM posts WHERE author_id=$user_id";//get id frpm manage users php
$thumbnails_result=mysqli_query($connection,$thumbnails_query);
if(mysqli_num_rows($thumbnails_result)>0)//we gor some records so we iterate and delete the thumbnails 
{
  while($thumbnail=mysqli_fetch_assoc($thumbnails_result))
  {
    $thumbnail_path='../images/'.  $thumbnail['thumbnail'];//get the thumbnail
    //delete thumbnail from images frolder if exists
    if($thumbnail_path)
    {
      unlink($thumbnail_path);
    }

  }
}
//delet from follower
$decrement="SELECT * from followed where following_user_id=$user_id ";
$decrementresult=mysqli_query($connection,$decrement);

while($decrementassoc=mysqli_fetch_assoc($decrementresult))
{$useid=$decrementassoc['followed_user_id'];
 $updatedecrement="UPDATE user_followers SET follower_count	=follower_count	-1 where 	user_id=$useid ";
 $ex1=mysqli_query($connection,$updatedecrement);
}
//delete from following 
$decrement1="SELECT * from followed where followed_user_id=$user_id ";
$decrementresult1=mysqli_query($connection,$decrement1);
while($decrementassoc1=mysqli_fetch_assoc($decrementresult1))
{$useid1=$decrementassoc1['following_user_id'];
 $updatedecrement1="UPDATE user_followers SET following_count	=following_count	-1 where 	user_id=$useid1 ";
 $ex=mysqli_query($connection,$updatedecrement1);
 
}
//
//delete from follower
$delfollow="DELETE FROM user_followers WHERE 	user_id=$user_id";
$delresult=mysqli_query($connection,$delfollow);
//folowing
$delfollowed="DELETE FROM followed WHERE 	following_user_id=$user_id || followed_user_id=$id";
$delresulted=mysqli_query($connection,$delfollowed);
//from saved
$deletesaved="DELETE FROM saved_posts WHERE uid	=$user_id";
$executesaved=mysqli_query($connection,$deletesaved);

//
$searchuse="SELECT * from users where id=$user_id ";
$searchuse_result=mysqli_query($connection, $searchuse);
$searchuse_fetch=mysqli_fetch_assoc($searchuse_result);
$olduser=$searchuse_fetch['username'];
function generateUniqueUsername($olduser) {
  return "deleted_" . $olduser; 
}
$newusername=generateUniqueUsername($olduser);
$new_avatar_name="deletedimage.jpg";
$formessgae="INSERT INTO users SET firstname='Deleted',lastname='Account',username='$newusername',email='deletedaccount',password='123456789',
avatar='$new_avatar_name',is_admin=0";
$formessgae_result=mysqli_query($connection, $formessgae);
$searchacc="SELECT * from users where username='$newusername' ";
$searchacc_result=mysqli_query($connection, $searchacc);
$searchacc_fetch=mysqli_fetch_assoc($searchacc_result);
$newid=$searchacc_fetch['id'];
$movesentmsg="UPDATE messages SET sender_id=$newid where sender_id=$user_id ";
$movesentmsg_result=mysqli_query($connection, $movesentmsg);
$moverecievmsg="UPDATE messages SET receiver_id=$newid where receiver_id=$user_id ";
$moverecievmsg_result=mysqli_query($connection, $moverecievmsg);
//DELETE USERFROM DB
$delete_user_query="DELETE FROM users WHERE id=$user_id";
$delete_user_result=mysqli_query($connection,$delete_user_query);

  }
 
header('location: '.ROOT_URL . 'logout.php');
die();
?> 

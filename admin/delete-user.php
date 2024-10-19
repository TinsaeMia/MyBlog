<?php
require('C:/xampp/htdocs/blog/admin/config/database.php');
//WE USE GET CUZ WE ARE GETTING ID FROM THE URL
if(isset($_GET['id']))
{
  //fetch user from database
  $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  $query="SELECT * FROM users WHERE id=$id";
  $result=mysqli_query($connection,$query);
  $user=mysqli_fetch_assoc($result);
  //make sure we gor only one user back


  if(mysqli_num_rows($result)==1)
  {
    //delete users avatar
  $avatar_name=$user['avatar'];
  $avatar_path='../images/'.$avatar_name;
  //is the image exists in our folder delete it
  if($avatar_path)
  {
    unlink($avatar_path);
  }
  }
 //delete all comments 
 $forcom="SELECT * FROM comments WHERE user_id=$id";
 $forcomresult=mysqli_query($connection,$forcom);
 while($forcomassoc=mysqli_fetch_assoc($forcomresult))
 {
  $vpid=$forcomassoc['post_id'];
  $vcid=$forcomassoc ['comment_id'];
  $delvotes="DELETE FROM votes where post_id=$vpid and comment_id=$vcid";
  $exvotes=mysqli_query($connection,$delvotes);
  
  
 }//to eliminate votes that are made by the user on other posts
 $delvotedcomment="DELETE FROM voted_comment where user=$id";
$exvotedcomment=mysqli_query($connection,$delvotedcomment);
 $delcom="DELETE FROM comments where user_id =$id ";
$excom=mysqli_query($connection,$delcom);
$delpostvotes="DELETE FROM post_votes where user_id=$id";
$expostvotes=mysqli_query($connection,$delpostvotes);
$delvoted_post="DELETE FROM voted_post where user=$id";
$exvoted_post=mysqli_query($connection,$delvoted_post);



  //FETCH ALL THUMB NAILS OF USER AND DELETE THEM
$thumbnails_query="SELECT thumbnail FROM posts WHERE author_id=$id";//get id frpm manage users php
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
$decrement="SELECT * from followed where following_user_id=$id ";
$decrementresult=mysqli_query($connection,$decrement);

while($decrementassoc=mysqli_fetch_assoc($decrementresult))
{$useid=$decrementassoc['followed_user_id'];//decrease follower count of the users that are being followed by the user being remoived
 $updatedecrement="UPDATE user_followers SET follower_count	=follower_count	-1 where 	user_id=$useid ";
 $ex=mysqli_query($connection,$updatedecrement);
 
}
//delete from following 
$decrement1="SELECT * from followed where followed_user_id=$id ";
$decrementresult1=mysqli_query($connection,$decrement1);
while($decrementassoc=mysqli_fetch_assoc($decrementresult1))
{$useid1=$decrementassoc['following_user_id'];
 $updatedecrement1="UPDATE user_followers SET following_count	=following_count-1 where 	user_id=$useid1 ";//decrease following count of the usersthat follow the user that is being removed
 $ex=mysqli_query($connection,$updatedecrement1);
 
}
//
$delfollow="DELETE FROM user_followers WHERE 	user_id=$id";
$delresult=mysqli_query($connection,$delfollow);
//folowed
$delfollowed="DELETE FROM followed WHERE 	following_user_id=$id || 	followed_user_id=$id";
$delresulted=mysqli_query($connection,$delfollowed);
//from saved
$deletesaved="DELETE FROM saved_posts WHERE  uid=$id";
$executesaved=mysqli_query($connection,$deletesaved);

//try
$searchuse="SELECT * from users where id=$id ";
$searchuse_result=mysqli_query($connection, $searchuse);
$searchuse_fetch=mysqli_fetch_assoc($searchuse_result);
$olduser=$searchuse_fetch['username'];
function generateUniqueUsername($olduser) {
  return "deleted_" . $olduser; 
}
$newusername=generateUniqueUsername($olduser);
$new_avatar_name="deletedimage.jpg";
$formessgae="INSERT INTO users SET firstname='Deleted',lastname='Account',username='$newusername',email='deletedaccount',password='123456789',avatar='$new_avatar_name',is_admin=0";
$formessgae_result=mysqli_query($connection, $formessgae);
$searchacc="SELECT * from users where username='$newusername' ";
$searchacc_result=mysqli_query($connection, $searchacc);
$searchacc_fetch=mysqli_fetch_assoc($searchacc_result);
$newid=$searchacc_fetch['id'];
$movesentmsg="UPDATE messages SET sender_id=$newid where sender_id=$id ";
$movesentmsg_result=mysqli_query($connection, $movesentmsg);
$moverecievmsg="UPDATE messages SET receiver_id=$newid where receiver_id=$id ";
$moverecievmsg_result=mysqli_query($connection, $moverecievmsg);
//DELETE USERFROM DB
$delete_user_query="DELETE FROM users WHERE id=$id";
$delete_user_result=mysqli_query($connection,$delete_user_query);

if (!$delete_user_result) {
  die("Query failed: " . mysqli_error($connection));
}

if(mysqli_errno($connection))
{
  $_SESSION['delete-user']="Couldn't delete '{$user['firstname']}' '{$user['lastname']}'";

}else
{$_SESSION['delete-user-success']="User {$user['firstname']} {$user['lastname']} is deleted  ";

}

}
header('location: '.ROOT_URL . 'admin/manage-users.php');
die();
?>
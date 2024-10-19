

<?php
require('C:/xampp/htdocs/blog/admin/config/database.php');

if(isset($_POST['submit'])){
//get updated form data
$id=$_SESSION['user-id'];
$previous_avatar_name=filter_var($_POST['previous_avatar_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$firstname=filter_var($_POST['firstname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$lastname=filter_var($_POST['lastname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$username=filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$avatar=$_FILES['avatar'];

if(!$firstname ){
  $_SESSION['edit-self']="please write your First Name";
 /*  header('location: '.ROOT_URL . 'admin/edit-self.php'); */
 /*  die(); */
}/*  */
elseif(!$lastname)
{
$_SESSION['edit-self']="please write your Last Name";
}
elseif(!$username)
{
$_SESSION['edit-self']="please write your username";
}
else
{
  //form is valid
//delete exsisting avatar if new avatar is available
if($avatar['name'])
{
  $previous_avatar_path='../images/'.$previous_avatar_name;
  if($previous_avatar_path)//if new avatar esists
  {
    unlink($previous_avatar_path);
  }


//work on new avatar.renaming it
$time=time();//make eacg image name upload unique using current timestamp
$avatar_name=$time . $avatar['name'];
$avatar_tmp_name=$avatar['tmp_name'];
$avatar_destination_path='../images/'.  $avatar_name;
//make sure the file is an image
$allowed_files=['png','jpg','jpeg'];
$extension= explode('.',$avatar_name);
$extension=end($extension);//getting extension
if(in_array($extension,$allowed_files))
{
//make sure image is not too large(1mb+)
if($avatar['size']<2_000_000)//2megabyte
{//upload image
  move_uploaded_file($avatar_tmp_name,$avatar_destination_path);

}
else{
  $_SESSION['edit-self']='Couldn not update post .Avatar size too big.should be less than 2mb';
}
}else{//if the file is not an image 
$_SESSION['edit-self']=' Couldn not update post.Avatar should be png,jpg,or jpeg';
}
}
//set thumbnail name if new one was uploaded else keep old thumbnail name
$avatar_to_insert=$avatar_name??$previous_avatar_name;
  //update user
  $checkuser="SELECT * FROM users WHERE id != $id;";//users outside of the user u are editing
  $excheckuser=mysqli_query($connection,$checkuser);
  $cheker=0;
  while($check=mysqli_fetch_assoc($excheckuser))
  {
    if($username==$check['username'])
    {
        $cheker=1;
    }
  }
  if($cheker==0)
 { $query1="UPDATE users SET firstname='$firstname', lastname='$lastname',username='$username',avatar='$avatar_to_insert' WHERE id=$id LIMIT 1";//WE ONLY UPDATE ONLY ONE USER AT A TIME
  $result1=mysqli_query($connection,$query1);
  if(mysqli_errno($connection))
  {
    $_SESSION['edit-self']="Failed to update your account.";
  }
  else
  {
    $_SESSION['edit-self-success']="Account updated successfully.";
  }
}
else
{
  $_SESSION['edit-self']="username taken .try a different one";


}
}

}
header('location: '.ROOT_URL . 'admin/manage-self.php');
die();
?>
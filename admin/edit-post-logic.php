<?php
require('C:/xampp/htdocs/blog/admin/config/database.php');
//make sure edit post update button was clicked
if(isset($_POST['submit']))
{
  $id=filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
  $previous_thumbnail_name=filter_var($_POST['previous_thumbnail_name'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);//used to delete the the thumbnail from the images folder
  $title=filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $body=filter_var($_POST['body'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $category_id=filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
  $is_featured=filter_var($_POST['is_featured'],FILTER_SANITIZE_NUMBER_INT);
  $thumbnail=$_FILES['thumbnail'];
  //set is_featured to 0 if its unchecked
  $is_featured=$is_featured==1?:0;
  //validate form datda
  if(!$title)
{
  $_SESSION['edit-post']="Couldn't update post.please enter the new post title";
}
elseif(!$category_id)
{
$_SESSION['edit-post']="Couldn't update post.Select  the new post category";
}
elseif(!$body){
  $_SESSION['edit-post']="Couldn't update post.please enter the new post body";
}
else{
//form is valid
//delete exsisting thumbnail if new thumbnail is available
if($thumbnail['name'])
{
  $previous_thumbnail_path='../images/'.$previous_thumbnail_name;
  if($previous_thumbnail_path)//if new thumbnail esists
  {
    unlink($previous_thumbnail_path);
  }


//work on new thumbnail.renaming it
$time=time();//make eacg image name upload unique using current timestamp
$thumbnail_name=$time . $thumbnail['name'];
$thumbnail_tmp_name=$thumbnail['tmp_name'];
$thumbnail_destination_path='../images/'.  $thumbnail_name;
//make sure the file is an image
$allowed_files=['png','jpg','jpeg'];
$extension= explode('.',$thumbnail_name);
$extension=end($extension);//getting extension
if(in_array($extension,$allowed_files))
{
//make sure image is not too large(1mb+)
if($thumbnail['size']<2_000_000)//2megabyte
{//upload image
  move_uploaded_file($thumbnail_tmp_name,$thumbnail_destination_path);

}
else{
  $_SESSION['edit-post']='Couldn not update post .Thumbnail size too big.should be less than 2mb';
}
}else{//if the file is not an image 
$_SESSION['edit-post']=' Couldn not update post.Thumbnail should be png,jpg,or jpeg';
}
}
}
//redirect to manage form page if form was invalid
if(isset($_SESSION['edit-post']))
{

  // me $_SESSION['add-post-data']=$_POST;
  header('location:' . ROOT_URL . 'admin/');
  die();
}else
{
  //add the post to the data base
  //first check if the current post is featured or not .if it is the set all the other posts is featured to zero because only one featured post 
  if($is_featured==1)
  {
    $zero_all_is_featured_query="UPDATE posts SET is_featured=0";
    $zero_all_is_featured_result=mysqli_query($connection,$zero_all_is_featured_query);
  }
//set thumbnail name if new one was uploaded else keep old thumbnail name
$thumbnail_to_insert=$thumbnail_name?? $previous_thumbnail_name;
//update post into db
$query="UPDATE posts SET title='$title',body='$body',thumbnail='$thumbnail_to_insert',category_id=$category_id,is_featured=$is_featured WHERE id=$id LIMIT 1";
$result=mysqli_query($connection,$query);
}
if(!mysqli_errno($connection))//everything went well
{
  $_SESSION['edit-post-success']="Post updated  successfully";//this is gonna be on manage 
}}
header('location:' . ROOT_URL . 'admin/');
die();
?>

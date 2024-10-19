<?php
require('C:/xampp/htdocs/blog/admin/config/database.php');
if(isset($_POST['submit']))
{echo $_POST['is_featured'];
  $author_id=$_SESSION['user-id'];//to get the current logged in user-from signin logic
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
  $_SESSION['add-post']="please enter post title";
}
elseif(!$category_id)
{
$_SESSION['add-post']="Select post category";
}
elseif(!$body){
  $_SESSION['add-post']="please enter post body";
}
elseif(!$thumbnail['name'])//if the naem of file is not available
{
$_SESSION['add-post']="Choose post thumbnail";
}
else{
//form is valid
//work on thumbnail and rename it so we dont have duplicates in our images folder
$time=time();//cant repeat.same as math.random
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
  $_SESSION['add-post']='File size too big.should be less than 2mb';
}
}else{//if the file is not an image 
$_SESSION['add-post']='File should be png,jpg,or jpeg';
}
}

//redirect bact (with form data) to add-post page if there is any problem
if(isset($_SESSION['add-post']))
{

  $_SESSION['add-post-data']=$_POST;
  header('location:' . ROOT_URL . 'admin/add-post.php');
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

//insert post into db
$query="INSERT INTO posts (title,body,thumbnail,category_id,author_id,is_featured)VALUES
('$title','$body','$thumbnail_name',$category_id,$author_id,$is_featured)";
$result=mysqli_query($connection,$query);
$get="SELECT * FROM posts WHERE thumbnail='$thumbnail_name' and author_id=$author_id";
$getr=mysqli_query($connection,$get);
$p=mysqli_fetch_assoc($getr);
$po=$p['id'];
$query1="INSERT INTO post_votes SET Likes=0,post_id=$po,Dislike=0,user_id=$author_id";
$result1=mysqli_query($connection,$query1);
if(!mysqli_errno($connection))//everything went well
{
  $_SESSION['add-post-success']="NEW post added successfully";//this is gonna be on manage 
  header('location:' . ROOT_URL . 'admin/');
  die();
}
}
}
header('location:' . ROOT_URL . 'admin/add-post.php');
die();
?>
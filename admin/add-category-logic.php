<?php
require 'C:/xampp/htdocs/blog/admin/config/database.php';
if(isset($_POST['submit']))
{
  //get form data
  $title=filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $description=filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if(!$title)
{
  $_SESSION['add-category']="please enter Title";//when admin did not add title
}
elseif(!$description)
{
$_SESSION['add-category']="please enter your Description";//when admin did not add description
}
if(isset(  $_SESSION['add-category']))//means we have an error so redirect back to add-category page with form data 
{$_SESSION['add-category-data']=$_POST;
  header('location: '.ROOT_URL . 'admin/add-category.php');
  die();
}
else//no problem occured
{
  //insert category into db
  $query="INSERT INTO categories (title,description) VALUES ('$title','$description')";
  $result=mysqli_query($connection,$query);
  if(mysqli_errno($connection))
  {
    $_SESSION['add-category']="Couldn't add category";
    header('location: '.ROOT_URL . 'admin/add-category.php');
    die();
  }
  else
  {
    {
      $_SESSION['add-category-success']="  $title Category is added Successfully.";
      header('location: '.ROOT_URL . 'admin/manage-catagories.php');
      die();
  }
}
}}
?>
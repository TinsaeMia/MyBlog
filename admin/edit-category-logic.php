<?php
require('C:/xampp/htdocs/blog/admin/config/database.php');
if(isset($_POST['submit']))
{
  $id=filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
  $title=filter_var($_POST['title'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $description=filter_var($_POST['description'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  if(!$title)
  {
    $_SESSION['edit-category']="please enter Title";
  }
  elseif(!$description)
  {
  $_SESSION['edit-category']="please enter your Description";
  }
  else
  { 
    $query="UPDATE categories SET title='$title',description='$description' WHERE id=$id LIMIT 1";
$result=mysqli_query($connection,$query);
if(mysqli_errno($connection))
{
$_SESSION['edit-category']="couldn't update $title category ";
}
else
{
  $_SESSION['edit-category-success']="category $title is updated successfully";
}
  }
}
header('location: '.ROOT_URL . 'admin/manage-catagories.php');
die();
?>
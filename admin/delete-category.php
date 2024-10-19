<?php
require('C:/xampp/htdocs/blog/admin/config/database.php');
//WE USE GET CUZ WE ARE GETTING ID FROM THE URL
if(isset($_GET['id']))
{
  $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  //onses we delete any category we are going to set our posts to the "UNCATEGORIZED' category

  //update category id of posts that belong to this category to id of uncategorized category//laterrr
$update_query="UPDATE posts SET category_id=7 WHERE category_id=$id";//the id of uncategorized category is 7
$update_result=mysqli_query($connection,$update_query);
if(!mysqli_errno($connection))
{
 //delete the category
 $query="DELETE FROM categories WHERE id=$id LIMIT 1";
 $result=mysqli_query($connection,$query);
$_SESSION['delete-category-success']="category  is deleted successfully";
 
}

}
header('location: '.ROOT_URL . 'admin/manage-catagories.php');
die();
?>
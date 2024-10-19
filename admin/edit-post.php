<?php
require('C:/xampp/htdocs/blog/admin/partials/header.php');
//fetch categories from db
$category_query="SELECT * FROM categories";
$categories=mysqli_query($connection,$category_query);
//fetch post data from the db if id is set
if(isset($_GET['id']))
{
  $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  $query="SELECT * FROM posts WHERE id=$id";
  $result=mysqli_query($connection,$query);
  $post=mysqli_fetch_assoc($result);
}
else//if we have no id and we are trying to access edit post we should be bounced back 
{
  header('location: '.ROOT_URL . 'admin/');//managr posts
  die();
}

?>

<section class="form__section">
  <div class="container form__section-container">
    <h2>Edit Post</h2>

    <form action="<?= ROOT_URL?>admin/edit-post-logic.php" enctype="multipart/form-data" method="post">
    <input type="hidden" value="<?=$post['id']?>"  name="id">
    <input type="hidden" value="<?=$post['thumbnail']?>"  name="previous_thumbnail_name">
      <input type="text" value="<?=$post['title']?>" placeholder="Title" name="title">
      <select name="category">
      <?php while($category=mysqli_fetch_assoc($categories)):?>
        <option value="<?= $category['id']?>"><?=$category['title']?></option>
        <?php  endwhile//to fill the dropdown?>
      </select>
      <textarea rows="10" placeholder="body" name="body"><?=$post['body']?></textarea>
      <?php  if(isset($_SESSION['user_is_admin'])):  //the only ppl that can feature a post are admins so check that?>
      <div class="form_control inline">
        <input type="checkbox" id="is_featured" name="is_featured" value="1" checked>
        <label for="is_featured" >Featured</label>
      </div>
 <?php endif?>
<div class="form_control">
  <label for="thumbnail">Change Thumbnail</label><br>
  <input type="file" name="thumbnail" id="thumbnail">
</div>
 
      <button type="submit" class="btn" name="submit">Update Posts</button>
   
      
  
    </form>
  </div>
</section>
<?php
include('../partials/footer.php');
   ?>
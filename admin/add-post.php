<?php
require('C:/xampp/htdocs/blog/admin/partials/header.php');
//fetch categories from db
$query="SELECT * FROM categories";
$categories=mysqli_query($connection,$query);

//get back form data if input was invalid
$title= $_SESSION['add-post-data']['title']??null;
$body= $_SESSION['add-post-data']['body']??null;

unset($_SESSION['add-post-data']);//delete form data session

?>
<section class="form__section">
  <div class="container form__section-container">
    <h2>Add Post</h2>
    <?php if(isset($_SESSION['add-post'])):?>
    <div class="alert__message error">
    <p><?=$_SESSION['add-post'];
 unset($_SESSION['add-post'])?></p>
    </div>
<?php endif?>
    <form action="<?= ROOT_URL?>admin/add-post-logic.php" enctype="multipart/form-data" method="post">
      <input type="text" name="title"  value="<?= $title?>" placeholder="Title">
      <select name="category">
      <?php while($category=mysqli_fetch_assoc($categories)):?>
        <option value="<?=$category['id']?>"><?=$category['title']?></option>
        <?php endwhile?>
      </select>
      <textarea rows="10" placeholder="body" name="body"><?= $body?></textarea>
      <?php  if(isset($_SESSION['user_is_admin'])):  //the only ppl that can feature a post are admins so check that?>
      <div class="form_control inline">
        <input type="checkbox" id="is_featured" value="1" name="is_featured" checked >
        <label for="is_featured" >Featured</label>
      </div>
    
      <?php endif?>
     
     
<div class="form_control">
  <label for="thumbnail">Add Thumbnail</label><br>
  <input type="file" name="thumbnail" id="thumbnail">
</div>

      <button type="submit" name="submit" class="btn">Add Posts</button>
   
      
  
    </form>
  </div>
</section>
<?php
include('../partials/footer.php');
   ?>

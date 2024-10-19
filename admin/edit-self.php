<?php
require('C:/xampp/htdocs/blog/admin/partials/header.php');

  $id=$_SESSION['user-id'];
  $query="SELECT * FROM users WHERE id=$id";
  $result=mysqli_query($connection,$query);
  $user=mysqli_fetch_assoc($result);

?>
 <?php
  if(isset($_SESSION['edit-self'])): ?>
 
<div class="alert__message error container">
  <p><?=$_SESSION['edit-self'];
  unset($_SESSION['edit-self'])?></p>
</div>
<?php elseif(isset($_SESSION['edit-self-success'])):?>
  <div class="alert__message success container">
  <p><?=$_SESSION['edit-self-success'];
  unset($_SESSION['edit-self-success'])?></p>
</div>
<?php endif?>
<section class="form__section">
  <div class="container form__section-container">
    <h2>Edit User</h2>
<form action="<?= ROOT_URL?>admin/edit-self-logic.php"  method="post"> <!-- enctype is required for forms with file input -->
<input type="hidden" value="<?=$user['avatar']?>"  name="previous_avatar_name">
  <input type="text" name="firstname" value="<?=$user['firstname']?>"  placeholder="First Name">
  <input type="text" name="lastname" value="<?=$user['lastname']?>"  placeholder="Last Name">
  <input type="text" name="username" value="<?=$user['username']?>"  placeholder="Username">
  <div class="form_control">
  <label for="avatar">Change Thumbnail</label><br>
  <input type="file" name="avatar" id="avatar">
 
</div>
 <button type="submit" name="submit" class="btn">Update info</button>

</form>
  </div>
</section>
<?php
include('../partials/footer.php');
   ?>
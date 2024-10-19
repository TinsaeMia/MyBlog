<?php
require('C:/xampp/htdocs/blog/admin/partials/header.php');
$current_admin_id=$_SESSION['user-id'];
//fetch categories from db
$query="SELECT * FROM categories ORDER BY title";
$categories=mysqli_query($connection,$query);
?>
<section class="dashboard">
<?php
    if(isset($_SESSION['add-category-success'])): //shows if adding category was successful?>
 
 <div class="alert__message success container">
   <p><?=$_SESSION['add-category-success'];//echo the success method in its found in add-category logic
   unset($_SESSION['add-category-success'])?></p>
 </div>
 <?php
    elseif(isset($_SESSION['add-category'])): //shows if there was any problem?>
 
 <div class="alert__message error container">
   <p><?=$_SESSION['add-category'];//echo the not successful method in its found in add-category logic
   unset($_SESSION['add-category'])?></p>
 </div>
 <?php
    elseif(isset($_SESSION['edit-category'])): //shows if there was any problem?>
 
 <div class="alert__message error container">
   <p><?=$_SESSION['edit-category'];//echo the not successful method inits found in edit-category logic
   unset($_SESSION['edit-category'])?></p>
 </div>
 <?php
    elseif(isset( $_SESSION['edit-category-success'])): //shows if there was no problem?>
 
 <div class="alert__message success container">
   <p><?= $_SESSION['edit-category-success'];//echo the  successful method in its found in add-category logic
   unset( $_SESSION['edit-category-success'])?></p></div>
   //
   <?php
   elseif(isset( $_SESSION['delete-category'])): //shows if there  was a problem?>
<div class="alert__message error container">
  <p><?= $_SESSION['delete-category'];//echo the not  successful method in its found in delete-category
  unset( $_SESSION['delete-category'])?></p></div>
  <?php
   elseif(isset( $_SESSION['delete-category-success'])): //shows if there was no problem?>
 
<div class="alert__message success container">
  <p><?= $_SESSION['delete-category-success'];//echo the  successful method inits found in delete-category 
  unset($_SESSION['delete-category-success'])?></p></div>
 <?php endif?>
  <div class="container dashboard_container">
    <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button> <!-- side bars for small devices -->
    <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
    <aside>
<ul>
  <li><a href="add-post.php"><i class="uil uil-pen"></i>
  <h5>Add Post</h5>
  </a></li>
  <li><a href="<?= ROOT_URL?>admin/index.php"><i class="uil uil-postcard"></i>
    <h5>Manage Post</h5>
    </a></li>
    <li><a href="<?= ROOT_URL?>admin/manage-self.php?id=<?=$current_admin_id?>" ><i class="uil uil-postcard"></i>
<h5>Settings</h5>
</a></li>
    <?php if(isset( $_SESSION['user_is_admin'])): ?>
    <li><a href="add-user.php"><i class="uil uil-plus"></i>
      <h5>Add User</h5>
      </a></li>
      <li><a href="manage-users.php"><i class="uil uil-users-alt"></i>
        <h5>Manage User </h5>
        </a></li>
        <li><a href="add-category.php"><i class="uil uil-edit"></i>
          <h5>Add Category</h5>
          </a></li>
          <li><a href="manage-catagories.php" class="active">
            <i class="uil uil-list-ul"></i>
            <h5>Manage Category</h5>
            </a></li>
            <?php endif ?>
</ul>
    </aside>
    <main>
<h2>Manage Categories</h2>
<?php
if(mysqli_num_rows($categories)>0):?>
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php while($category=mysqli_fetch_assoc($categories)):?>
    <tr>
      <td><?=$category['title']?></td>
      <td><a href="<?=ROOT_URL?>admin/edit-category.php?id=<?= $category['id'] ?>" class="btn sm">Edit</a></td>
      <form action="<?=ROOT_URL?>admin/confirmcategorydelete.php?id=<?= $category['id']?>" method="post">
      <td> <button type="submit" name="submit"class="btn sm  danger">Delete</a></td>
      </form>
    </tr>
    <?php endwhile?>
  </tbody>
</table>
<?php else:?>
  <div class="alert__message error">
  <?= "No categories found"?>
</div>
<?php endif?>
    </main>
  </div>
</section>
<?php
include('../partials/footer.php');
   ?>
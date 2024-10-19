<?php
include('C:/xampp/htdocs/blog/admin/partials/header.php');
//fetch current users posts from db
$current_user_id=$_SESSION['user-id'];
$query="SELECT id,title,category_id FROM posts WHERE author_id=$current_user_id ORDER BY id DESC";
$posts=mysqli_query($connection,$query);
?>
<section class="dashboard">
<?php
    if(isset( $_SESSION['add-post-success'])): //shows if adding post was successful?>
 
 <div class="alert__message success container">
   <p><?=$_SESSION['add-post-success'];//echo the success method in its found in add-category logic
   unset($_SESSION['add-post-success'])?></p>
 </div>
 <?php
    elseif(isset( $_SESSION['edit-post-success'])): //shows if editing post was successful?>
 
 <div class="alert__message success container">
   <p><?=$_SESSION['edit-post-success'];//echo the success method in its found in edit-post logic
   unset($_SESSION['edit-post-success'])?></p>
 </div>
 <?php elseif(isset($_SESSION['edit-post'])):?>
    <div class="alert__message error">
    <p><?=$_SESSION['edit-post'];
 unset($_SESSION['edit-post'])?></p>
    </div>
    <?php
   elseif(isset( $_SESSION['delete-post-success'])): //shows if deleting post was successful?>
 
<div class="alert__message success container">
  <p><?=$_SESSION['delete-post-success'];//echo the success method in its found in delete-post logic
  unset($_SESSION['delete-post-success'])?></p>
</div>

 <?php endif?>
  <div class="container dashboard_container">
    <button id="show_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button> <!-- side bars for small devices -->
    <button id="hide_sidebar-btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
    <aside>
<ul>
  <li><a href="add-post.php"><i class="uil uil-pen"></i>
  <h5>Add Post</h5>
  </a></li>
  <li><a href="<?= ROOT_URL?>admin/index.php" class="active"><i class="uil uil-postcard"></i>
    <h5>Manage Post</h5>
    </a></li>
    <li><a href="<?= ROOT_URL?>admin/manage-self.php?id=<?=$current_user_id?>" ><i class="uil uil-postcard"></i>
   <h5>Settings</h5>
   </a></li>
    <?php if(isset( $_SESSION['user_is_admin'])): ?>
    <li><a href="add-user.php"><i class="uil uil-plus"></i>
      <h5>Add User</h5>
      </a></li>
      <li><a href="manage-users.php" ><i class="uil uil-users-alt"></i>
        <h5>Manage User </h5>
        </a></li>
        <li><a href="add-category.php"><i class="uil uil-edit"></i>
          <h5>Add Category</h5>
          </a></li>
          <li><a href="manage-catagories.php" >
            <i class="uil uil-list-ul"></i>
            <h5>Manage Category</h5>
            </a></li>
            <?php endif?>
</ul>
    </aside>
    <main>
<h2>Manage Posts</h2>
<?php if(mysqli_num_rows($posts)>0):?>
<table>
  <thead>
    <tr>
      <th>Title</th>
      <th>Category</th>
      <th>Edit</th>
      <th>Delete</th>

    </tr>
  </thead>
  <tbody>
 <?php while($post=mysqli_fetch_assoc($posts)):?>
 <!-- get category title of each post from categories table -->
  <?php $category_id=$post['category_id'];
  $category_query="SELECT title FROM categories WHERE id=$category_id";
  $category_result=mysqli_query($connection,$category_query); 
  $category=mysqli_fetch_assoc($category_result);?>
    <tr>
      <td><?=$post['title']?></td>
      <td><?=$category['title']?></td>
    

      <td><a href="<?=ROOT_URL?>admin/edit-post.php?id=<?=$post['id']?>" class="btn sm">Edit</a></td>
      
      <td><a href="<?=ROOT_URL?>admin/delete-post.php?id=<?=$post['id']?>" class="btn sm  danger">Delete</a></td>

    </tr>
    <?php endwhile?>
  </tbody>
</table>
<?php else:?>
  <div class="alert__message error">
  <?= "No posts found"?>
</div>
<?php endif?>

    </main>
  </div>
</section>
<?php
include('../partials/footer.php');
   ?>
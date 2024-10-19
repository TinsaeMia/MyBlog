<?php
require('C:/xampp/htdocs/blog/admin/partials/header.php');
//include('./config/constants.php');
//fetch users from data base except for current user
$current_admin_id=$_SESSION['user-id'];//get current admin id
$query="SELECT * FROM  users WHERE NOT id=$current_admin_id";
$users=mysqli_query($connection,$query);

?>
<section class="dashboard">
<?php
    if(isset($_SESSION['add-user-success'])): //shows if added user was successful?>
 
 <div class="alert__message success container">
   <p><?=$_SESSION['add-user-success'];//echo the success method in $_SESSION['signup-success']its found innsignup logic
   unset($_SESSION['add-user-success'])?></p>
 </div>
 <?php
    elseif(isset($_SESSION['edit-user-success'])): //shows if editing user was successful?>
 
 <div class="alert__message success container">
   <p><?=$_SESSION['edit-user-success'];//echo the success method in $_SESSION['signup-success']its found inn edit user logic
   unset($_SESSION['edit-user-success'])?></p>
 </div>
 <?php
   elseif(isset($_SESSION['edit-user'])): //shows if editing user was not successful?>
 
<div class="alert__message error container">
  <p><?=$_SESSION['edit-user'];//echo the success method in $_SESSION['signup-success']its found inn edit user logic
  unset($_SESSION['edit-user'])?></p>
</div>

<?php
   elseif(isset($_SESSION['delete-user'])): //shows if deleting user was not successful?>
 
<div class="alert__message error container">
  <p><?=$_SESSION['delete-user'];//echo the success method in $_SESSION['signup-success']its found inn edit user logic
  unset($_SESSION['delete-user'])?></p>
</div>
<?php
   elseif(isset($_SESSION['delete-user-success'])): //shows if deleting user was not successful?>
 
<div class="alert__message success container">
  <p><?=$_SESSION['delete-user-success'];//echo the success method in $_SESSION['signup-success']its found inn delete user logic
  unset($_SESSION['delete-user-success'])?></p>
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
      <li><a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i>
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

<h2>Manage Users</h2>
<?php //check if there are users 
if(mysqli_num_rows($users)>0):?>
<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Username</th>
      <th>Edit</th>
      <th>Delete</th>
      <th>Admin</th>
    </tr>
  </thead>
  <tbody>
    <?php while($user=mysqli_fetch_assoc($users)):?>
    <tr>
      <td><?="{$user['firstname']} {$user['lastname']}"?></td>
      <td><?=$user['username'] ?></td>
      <?php if($_SESSION['user-id']!=61):?>
    <?php if($user['is_admin']==1):?>
      <td><a href="javascript:void(0);" class="btn sm" onclick="return false;">Edit </a></td>
      <td><a href="javascript:void(0);" class="btn sm danger" onclick="return false;">Delete</a></td>
<?php else:?>
  <td><a href="<?=ROOT_URL?>admin/edit-user.php?id=<?= $user['id'] //so we can edit this particular user ?>" class="btn sm">Edit
</a></td>
<form action="<?=ROOT_URL?>admin/confirmuserdelete.php?id=<?= $user['id']?>" method="post">
  <td><button type="submit" name="submit" class="btn sm  danger">Delete</button></td>
</form>
<?php endif?>
<?php else:?>
  <td><a href="<?=ROOT_URL?>admin/edit-user.php?id=<?= $user['id'] //so we can edit this particular user ?>" class="btn sm">Edit
</a></td>
<form action="<?=ROOT_URL?>admin/confirmuserdelete.php?id=<?= $user['id']?>" method="post">
  <td><button type="submit" name="submit"class="btn sm  danger">Delete</button></td>
</form>
<?php endif?>
      <td>
        <?=$user['is_admin']?'Yes':'No' //check if user is admin or not then display yes or no?>
      </td>
    </tr>
    <?php endwhile?>
  </tbody>
</table>
<?php else:?>
<div class="alert__message error">
  <?= "No users found"?>
</div>
<?php endif?>
    </main>
  </div>
</section>
<?php
include('../partials/footer.php');
   ?>
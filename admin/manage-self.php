<?php
include('C:/xampp/htdocs/blog/admin/partials/header.php');
$userid=$_SESSION['user-id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete self</title>
  <!--  ICONSCOUT CDN -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<link rel="stylesheet"href="<?=ROOT_URL?>admin/manageselfstyle.css">
  <!--   google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> 


</head>

<body>
<?php if(isset($_SESSION['edit-self'])): //shows if editing user was not successful?>
 
<div class="alert__message error container section_extra-margin " style="margin-bottom: 0;">
  <p><?=$_SESSION['edit-self'];//echo the success method in $_SESSION['signup-success']its found inn edit user logic
  unset($_SESSION['edit-self'])?></p>
</div>
<?php elseif(isset($_SESSION['edit-self-success'])): ?>
  <div class="alert__message success container section_extra-margin"  style="margin-bottom: 0;">
   <p><?=$_SESSION['edit-self-success'];//echo the success method in $_SESSION['signup-success']its found inn edit user logic
   unset($_SESSION['edit-self-success'])?></p>
 </div>
<?php endif?>
  <div class="big">
 
  <ul  >
 <h3> <li class=" list inner" style="font-weight: 800;color:aqua">   Settings</li></h3>
    <li class="btn list inner"><a href="<?=ROOT_URL?>admin/edit-self.php">edit your account</a></li>
<li class="btn list inner"><a href="<?=ROOT_URL?>admin/myposts.php"> your Posted posts</a></li><br>
<li class="btn list inner"><a href="<?=ROOT_URL?>admin/myfollowers.php"> your Followers</a></li>
<li class="btn list inner"><a href="<?=ROOT_URL?>admin/myfollowing.php"> your Following</a></li>
<li class="btn list inner"><a href="<?=ROOT_URL?>admin/mysaved.php"> your Saved posts</a></li>
<li class="btn list inner"><a href="<?=ROOT_URL?>admin/myliked.php"> your liked posts</a></li>
<!-- <li class="btn list inner"><a href="<?=ROOT_URL?>admin/Theme.php"> Themed</a></li> -->

<li><form action="<?=ROOT_URL?>admin/confirmdeleteself.php" method="post">
<button  type="submit"  name="submit" class="btn list inner "  >Delete your account</button>
</form></li>
  </ul>

  </div>

</body>
</html>
<?php
include('../partials/footer.php');
   ?>

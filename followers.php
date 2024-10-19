<?php
require('C:/xampp/htdocs/blog/partials/header.php');
$id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
$follower="SELECT * FROM followed where followed_user_id=$id";
$followersresult=mysqli_query($connection,$follower);
$nym=mysqli_num_rows($followersresult);
$self="SELECT * FROM users where id=$id";
$selfresult=mysqli_query($connection,$self);
$selfassoc=mysqli_fetch_assoc($selfresult);//so i can go back tp post page
?>
<link rel="stylesheet" href="<?=ROOT_URL?>follow.css">
<h3 class="section_extra-margin  fol" ><a href="<?=ROOT_URL?>userposts.php?id=<?=$id?>">@<?=$selfassoc['username']?>'s&nbsp;<i style="font-size: 2rem;" class="uil uil-user-plus"></i></a> </h3>
<div class="followers ">
 
  <?php if ($nym!=0):?>
<?php 
while($followers=mysqli_fetch_assoc($followersresult)):?>
  <?php
$uid=$followers['following_user_id'];
$getuid="SELECT * FROM users where id=$uid ";
$getuidresult=mysqli_query($connection,$getuid);
$getuidassoc=mysqli_fetch_assoc($getuidresult);
  ?>
<ul style="list-style-type: none;" >
  <li  > 
  <div class="post__author">
  <div class="post__author_avatar">
  <a href="<?=ROOT_URL?>userposts.php?id=<?=$getuidassoc['id']?>"> <img src="./images/<?=$getuidassoc['avatar']?>" alt=""></a> <!-- author photo -->
  </div>
  <div class="post_author_info"><!-- author name and time of post -->
<h5> <a href="<?=ROOT_URL?>userposts.php?id=<?=$getuidassoc['id']?>">@<?= $getuidassoc['username']?></a></h5></div>
  </div> </li>
</ul>
  <?php endwhile?>
  <?php else :?>
    <div class="alert__message error section_extra-margin">
<p>no one is following u</p>
</div>
  <?php endif?>
</div>
<?php
include('./partials/footer.php');
   ?>

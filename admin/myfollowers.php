<?php
require('C:/xampp/htdocs/blog/partials/header.php');
$id=$_SESSION['user-id'];
$follower="SELECT * FROM followed where followed_user_id=$id";
$followersresult=mysqli_query($connection,$follower);
$followers_num=mysqli_num_rows($followersresult);



?>


<link rel="stylesheet" href="<?=ROOT_URL?>admin\myfollowers.css">
<a href="<?=ROOT_URL?>admin/manage-self.php?id=<?= $id?>" class="btn " style="margin-top: 5rem;margin-bottom: 0rem;">Go to setting</a>
<h3 class="  fol" ><a href="<?=ROOT_URL?>userposts.php?id=<?=$id?>">Your followers&nbsp;<i style="font-size: 2rem;" class="uil uil-user-plus"></i></a> </h3>
<div class="followers ">
 
  <?php if ($followers_num!=0):?>
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
  <a href="<?=ROOT_URL?>userposts.php?id=<?=$getuidassoc['id']?>"> <img src="../images/<?=$getuidassoc['avatar']?>" alt=""></a> <!-- author photo -->
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




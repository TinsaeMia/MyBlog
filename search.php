<?php
require('C:/xampp/htdocs/blog/partials/header.php');
//if the user actually entered a search
if(isset($_GET['search']) && isset($_GET['submit'])){//from blog.php
$search=filter_var($_GET['search'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);//get the search input
$query="SELECT * FROM posts WHERE title LIKE '%$search%' ORDER BY date_time DESC";//If what they typed can be found in any of the titles show that post
$posts=mysqli_query($connection,$query);
$query2="SELECT * FROM users WHERE username LIKE '%$search%' or  firstname  LIKE '%$search%' ORDER BY username ASC";//If what they typed can be found in any of the titles show that post
$users=mysqli_query($connection,$query2);

}

else{
  header('location: '.ROOT_URL . 'blog.php');
 die();
}?>

<!-- so if the post title also contains the username or first name -->
<?php if(mysqli_num_rows($posts)>0 || (mysqli_num_rows($posts)>0 && mysqli_num_rows($users)>0) ):?>
  <?php if(mysqli_num_rows($users)>0):?>
    <h2 style="margin-top: 5rem;margin-left:47%;color:lightseagreen;">users</h2>
<div class="followers " style="margin-top: 0.5rem;">
 

 <?php while($user=mysqli_fetch_assoc($users)):?>
   <?php
 $uid=$user['id'];
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
 
 </div>
 <?php endif?>
<section class="posts section_extra-margin">
<div class="container posts__container">
  <?php while($post=mysqli_fetch_assoc($posts)): ?>
  <article class="post">
    <div class="post__thumbail">
    <a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>">  <img src="./images/<?= $post['thumbnail'];?> " ></a>
    </div>
    <div class="post__info">
    <?php //fetch category from categories table using category_id posts table
$category_id=$post['category_id'];
$category_query="SELECT * FROM categories WHERE id=$category_id";
$category_result=mysqli_query($connection,$category_query);
$category=mysqli_fetch_assoc($category_result);

?>
      <a href="<?=ROOT_URL?>category-posts.php?id=<?=$post['category_id']?>" class="category__button"><?=$category['title']?></a>
      <h3 class="post__title"><a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>"><?= $post['title']?></a></h3>
 
      <p class="post__body">
<?=  substr($post['body'],0,40)?>...</p>
   
      <div class="post__author">
        <?php
        //fetch author from user by using author id
$author_id=$post['author_id'];
$author_query="SELECT * FROM users WHERE id=$author_id";
$author_result=mysqli_query($connection,$author_query);
$author=mysqli_fetch_assoc($author_result);
      ?>
        <div class="post__author_avatar">
        <a href="<?=ROOT_URL?>userposts.php?id=<?=$author['id']?>">    <img src="./images/<?=$author['avatar']?>" alt=""> <!-- author photo --></a>
        </div>
        <div class="post_author_info"><!-- author name and time of post -->
        <h5>By: <?= "{$author['firstname']} {$author['lastname']}"?></h5>
          <small> <?=date("M d,Y - H:i",strtotime($post['date_time']))//date it was posted?></small>
        </div>
      </div>
    </div>
  </article>
<?php endwhile?>
</div>
</section>
 <?php elseif(mysqli_num_rows($users)>0):?>
  <h2 style="margin-top: 5rem;margin-left:47%;color:lightseagreen;">users</h2>
  <div class="followers " style="margin-top: 0.5rem;">
 

 <?php while($user=mysqli_fetch_assoc($users)):?>
   <?php
 $uid=$user['id'];
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
 
 </div>
 <?php else:?>

  <div class="alert__message error lg section_extra-margin ">
    <p>
      No posts or user found for this search
    </p>
  </div>
  <?php endif?>
<!-- ----------------------------------------------------------------------------------END OF POST SECTION------------------------------------------------ 
-->
  <!-- -------------------------------------start OF CATEGORY BUTTONS------------------------- -->
<section class="category__buttons">
    <div class="container category__buttons-container">
      <?php
$all_categories_query="SELECT * FROM categories";
$all_categories=mysqli_query($connection,$all_categories_query);
      ?>
      <?php while($category=mysqli_fetch_assoc($all_categories)):?>
      <a href="<?=ROOT_URL?>category-posts.php?id=<?=$category['id']//id of the category?>" class="category__button">
        <?=$category['title']?>
      </a>
      <?php endwhile?>
    </div>
  </section>
  <!-- -------------------------------------END OF CATEGORY BUTTONS------------------------- -->
<?php
require 'partials/footer.php';?>
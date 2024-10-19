<?php
require('C:/xampp/htdocs/blog/partials/header.php');

if(isset($_GET['id']))
{
  $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  $p=0;
$USERS="SELECT * FROM users WHERE id=$id";
$result=mysqli_query($connection,$USERS);
$user=mysqli_fetch_assoc($result);
$user_id=$user['id'];
$Upost="SELECT * FROM posts WHERE author_id=$id ORDER BY date_time DESC ";//recent post
$posts=mysqli_query($connection,$Upost);
$Upost1="SELECT * FROM posts WHERE author_id=$id ORDER BY date_time DESC ";//recent post
$posts1=mysqli_query($connection,$Upost);
$li=0;
$di=0;
$like="SELECT * FROM post_votes WHERE user_id	=$id ";
$likeresult=mysqli_query($connection,$like);
while($liked=mysqli_fetch_assoc($likeresult))
{
$li+=$liked['Likes'];
$di+=$liked['Dislike'];
}
while($post1=mysqli_fetch_assoc($posts1))
{
$p=$p+1;
}
$follow="SELECT * FROM user_followers WHERE user_id=$id ";
$followesult=mysqli_query($connection,$follow);
$follower=mysqli_fetch_assoc($followesult);
$num_of_followers=$follower['follower_count'];
$uid=$_SESSION['user-id'];
$onc="SELECT * FROM followed where following_user_id=$uid and followed_user_id=$id ";
$o=mysqli_query($connection,$onc);
$followingppl="SELECT * FROM followed where following_user_id=$id";//to get num of following
$followingresult=mysqli_query($connection,$followingppl);
$num_of_following=0;
while($following=mysqli_fetch_assoc($followingresult))
{$num_of_following=$num_of_following+1;

}
}
 else{
  header('location: '.ROOT_URL . 'blog.php');
  die();
}
 
?>
<style>
.follow
{
  background-color: brown;
  color: lightseagreen;
  font-weight: 600;
  cursor: pointer;
  border-radius: 0.5rem;
  font-size: 0.9rem;
}
.follow:hover
{
  background-color:white;
  transition:all 300ms ease; 
 
}
.follower
{
  background-color: #2040B2;
  color: lightseagreen;
  font-weight: 600;
  cursor: pointer;
  border-radius: 0.5rem;
  font-size: 0.9rem;
}
.follower:hover
{
  background-color:white;
  transition:all 300ms ease; 
 
}
.category__title
{
  height: 25rem;

}
  </style>
<!--  user name -->
<header class="category__title">
      <div >
        <img src="./images/<?=$user['avatar']?>" alt=""> <!-- author 
photo -->  <h3><?='@'.$user['username']?></h3>
<?php  $u=$user['username'] ;?>
 <?php 
if (str_contains($u,'deleted_')==false):?>
<form><h3 style="margin: 0;"><a href="<?=ROOT_URL?>followers.php?id=<?=$id?>" class="follower">followers:</a>&nbsp;<?=$num_of_followers?>
 <a href="<?=ROOT_URL?>following.php?id=<?=$id?>" class="follower">following:</a>&nbsp;<?=$num_of_following?>&nbsp;</form>



 <?php if (isset($_SESSION['user-id'])):?>

<?php if (mysqli_num_rows($o)==0): ?>
<a href="<?=ROOT_URL?>follow.php?id=<?=$id?>" class="follow"><i class="uil uil-user-plus" ></i>  follow</a></h3>
<?php else:?>
  <a href="<?=ROOT_URL?>unfollow.php?id=<?=$id?>" class="follow"><i class="uil uil-user-plus"></i> unfollow</a></h3> 
<?php endif?>
<?php endif?>
<h3 style="margin-top: 0; "> posts: &nbsp;<?=$p?> &nbsp;<i class="uil uil-thumbs-up"></i>:&nbsp;<?=$li?>  &nbsp; <i class="uil uil-thumbs-down"></i>:&nbsp;<?=$di?> &nbsp;</h3>
<?php endif?>

<?php if (isset($_SESSION['user-id'])):?>
<a class="btn" href="<?=ROOT_URL?>message.php?id=<?=$id?>"> <i class="uil uil-envelope-add"></i></a>
<?php endif?>
   
      </div>
</header>
<section class="posts <?=$featured ? '':'section_extra-margin'?>">
    <div class="container posts__container">
      <?php while($post=mysqli_fetch_assoc($posts)): ?>
      <article class="post">
        <div class="post__thumbail">
        <a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>"><img src="./images/<?= $post['thumbnail'];?> " ></a>
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
              <img src="./images/<?=$author['avatar']?>" alt=""> <!-- author photo -->
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
  <!-- ----------------------------------------------------------------------------------END OF POST SECTION------------------------------------------------ -->
  <!-- 
below post the buttons to choose category -->
  <!-- ----------------------------------------------------------------------------------------CATEGORY BUTTONS------------------------------------------------  -->
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
include('./partials/footer.php');
   ?>
<?php
require('C:/xampp/htdocs/blog/partials/header.php');
//fetch featured post from db
$featured_query= "SELECT * FROM posts WHERE is_featured=1";
 $featured_result=mysqli_query($connection,$featured_query);
 $featured=mysqli_fetch_assoc($featured_result);

 //fetch nine posts from posts table
 $query="SELECT * FROM posts ORDER BY date_time DESC LIMIT 9";//recent post
 $posts=mysqli_query($connection,$query);
?>
<?php 
//SHOW FEATURED POSTS IF THERES ANY
if(mysqli_num_rows($featured_result)==1): //if we dont have featured posts we shouldnt show featured posts?>
  <section class="featured">
    <div class="container featured_container">
      <div class="post__thumbail"> <!-- CONTAINING IMAGE -->
      <a href="<?=ROOT_URL?>post.php?id=<?=$featured['id']?>">   <img src="./images/<?= $featured['thumbnail']?>" alt=""></a>
      </div>
      <div class="post__info">

      <?php //fetch category from categories table using category_id posts table
      $category_id=$featured['category_id'];
      $category_query="SELECT * FROM categories WHERE id=$category_id";
      $category_result=mysqli_query($connection,$category_query);
      $category=mysqli_fetch_assoc($category_result);
    
      ?>
        <a href="<?=ROOT_URL?>category-posts.php?id=<?=$featured['category_id']//if we press the category it takes us to the posts under the category?>" class="category__button"><?=$category['title']?></a><h3 style="color: gold;">@featured post</h3>
        <h2 class="post__title"><a href="<?=ROOT_URL?>post.php?id=<?=$featured['id']?>"> <?= $featured['title']?></a></h2>
        <p class="post__body">
        <?= substr($featured['body'],0,40)//get only 150 character of the body ?>...
        </p>
      
        <div class="post__author">
          <?php
//fetch author from user by using author id
$author_id=$featured['author_id'];
$author_query="SELECT * FROM users WHERE id=$author_id";
$author_result=mysqli_query($connection,$author_query);
$author=mysqli_fetch_assoc($author_result);
          ?>
         
          <div class="post__author_avatar">
        
          <a href="<?=ROOT_URL?>userposts.php?id=<?=$author['id']?>"> <img src="./images/<?= $author['avatar']?>" alt=""></a> <!-- author photo -->
          </div>
         

          <div class="post_author_info"><!-- author name and time of post -->
       <h5>By: <?= "{$author['firstname']} {$author['lastname']}"?></h5>
   <small> <?=date("M d,Y - H:i",strtotime($featured['date_time']))//date it was posted?></small>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php endif?>
  <!-- -----------------------------------END OF FEATURED------------------------------- -->

  <section class="posts <?=$featured?'':'section_extra-margin'?>">
    <div class="container posts__container">
      <?php while($post=mysqli_fetch_assoc($posts)): ?>
     
      <article class="post">
        <div class="post__thumbail">
        <a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>"> <img src="./images/<?= $post['thumbnail'];?> " ></a>
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
            <a href="<?=ROOT_URL?>userposts.php?id=<?=$author['id']?>">     <img src="./images/<?=$author['avatar']?>" alt=""> <!-- author photo --></a>
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
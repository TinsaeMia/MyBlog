<?php
require('C:/xampp/htdocs/blog/partials/header.php');
 //fetch all posts from posts table
 $query="SELECT * FROM posts ORDER BY date_time DESC ";//recent post
 $posts=mysqli_query($connection,$query);
?>
<!--  ---------in blog page we have a serch bar---------- -->
<section class="search_bar">
  <form class="container search_bar-container" action="<?=ROOT_URL?>search.php" method="get">
    <div>
     <i class="uil uil-search"></i> 
     <input type="search" name="search" placeholder="Search">
 
    </div>
    <button type="submit" name="submit" class="btn">GO</button>
  </form>
</section>
<!-- ========================END OF SEARCH================================ -->
<section class="posts <?=$featured ? '':'section_extra-margin'?>">
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
            <a href="<?=ROOT_URL?>userposts.php?id=<?=$author['id']?>"> <img src="./images/<?=$author['avatar']?>" alt=""> </a><!-- author photo -->
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
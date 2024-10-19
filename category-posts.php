<?php
require('C:/xampp/htdocs/blog/partials/header.php');
//fetch posts if id is set
if(isset($_GET['id']))//make sure we have an id in our url before getting here
{
  $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  $query="SELECT * FROM posts WHERE category_id=$id ORDER BY date_time DESC";
  $posts=mysqli_query($connection,$query);

}
else{
  header('location: '.ROOT_URL . 'blog.php');
  die();
}
?>
<!--  category title -->
<header class="category__title">
  <h2>
<?php //fetch category from categories table using category_id posts table
 $category_id=$id;
 $category_query="SELECT * FROM categories WHERE id=$category_id";
 $category_result=mysqli_query($connection,$category_query);
 $category=mysqli_fetch_assoc($category_result);
 echo $category['title'];
 ?>
</h2>
</header>
<!--==============End of category title============================== -->
<?php if (mysqli_num_rows($posts)>0):?>
  <section class="posts">
    <div class="container posts__container">
      <?php while($post=mysqli_fetch_assoc($posts)): ?>
      <article class="post">
        <div class="post__thumbail">
        <a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>">    <img src="./images/<?= $post['thumbnail']?> " ></a>
        </div>
        <div class="post__info">
 
         
          <h3 class="post__title"><a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>"><?= $post['title']?></a></h3>
          <p class="post__body">
          <?= substr($post['body'],0,40)?>...</p>
          <div class="post__author">
            <?php
            //fetch author from user by using author id
$author_id=$post['author_id'];
$author_query="SELECT * FROM users WHERE id=$author_id";
$author_result=mysqli_query($connection,$author_query);
$author=mysqli_fetch_assoc($author_result);
          ?>
            <div class="post__author_avatar">
             <a href="<?=ROOT_URL?>userposts.php?id=<?=$author['id']?>">   <img src="./images/<?=$author['avatar']?>" alt=""> <!-- author photo --></a>
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
  <?php else:?>
    <div class="alert__message error lg">
      <p>
No posts found for this category
      </p>
    </div>
    <?php endif?>
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
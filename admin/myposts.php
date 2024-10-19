<?php
include('C:/xampp/htdocs/blog/admin/partials/header.php');
$me=$_SESSION['user-id'];
$query="SELECT * from posts where author_id=$me";
$result=mysqli_query($connection,$query);

?>
<a href="<?=ROOT_URL?>admin/manage-self.php?id=<?= $me?>" class="btn " style="margin-top: 5rem;margin-bottom: 0rem;">Go to setting</a>
<section class="posts">
    <div class="container posts__container">
      <?php while($post=mysqli_fetch_assoc($result)): ?>
      <article class="post">
        <div class="post__thumbail">
        <a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>"><img src="../images/<?= $post['thumbnail'];?> " ></a>
        </div>
        <div class="post__info">
          <h3 class="post__title"><a href="<?=ROOT_URL?>post.php?id=<?=$post['id']?>"><?= $post['title']?></a></h3>
     
          <p class="post__body">
<?=  substr($post['body'],0,40)?>...</p>
       
          <div class="post__author">
            <div class="post_author_info"><!-- author name and time of post -->
          
              <small> <?=date("M d,Y - H:i",strtotime($post['date_time']))//date it was posted?></small>
            </div>
          </div>
        </div>
      </article>
<?php endwhile?>
    </div>
</section>
  <!-- ----------------------------------------------------------------------------------END OF POST SECTION------------------------------------------------ 
-->
  <!-- 
below post the buttons to choose category -->
  <!-- ----------------------------------------------------------------------------------------CATEGORY 
BUTTONS------------------------------------------------  -->
  
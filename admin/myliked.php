<?php
include('C:/xampp/htdocs/blog/admin/partials/header.php');
$me=$_SESSION['user-id'];
$query="SELECT * from voted_post where user=$me and Likes=1";
$result=mysqli_query($connection,$query);


?>
<a href="<?=ROOT_URL?>admin/manage-self.php?id=<?= $me?>" class="btn " style="margin-top: 5rem;margin-bottom: 0rem;">Go to setting</a>
<section class="posts">
    <div class="container posts__container">
      <?php while($resultassoc=mysqli_fetch_assoc($result)): ?>
        <?php
        $pid=$resultassoc['post_id'];
 $query1="SELECT * from posts where id=$pid";
 $result1=mysqli_query($connection,$query1);
 $result1ass=mysqli_fetch_assoc($result1);
        ?>
      <article class="post">
        <div class="post__thumbail">
        <a href="<?=ROOT_URL?>post.php?id=<?=$result1ass['id']?>"><img src="../images/<?= $result1ass['thumbnail'];?> " ></a>
        </div>
        <div class="post__info">
          <h3 class="post__title"><a href="<?=ROOT_URL?>post.php?id=<?=$result1ass['id']?>"><?= $result1ass['title']?></a></h3>
     
          <p class="post__body">
<?=  substr($result1ass['body'],0,40)?>...</p>
       
          <div class="post__author">
            <div class="post_author_info"><!-- author name and time of post -->
          
              <small> <?=date("M d,Y - H:i",strtotime($result1ass['date_time']))//date it was posted?></small>
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
  
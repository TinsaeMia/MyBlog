
<?php
require('C:/xampp/htdocs/blog/partials/header.php');


if(isset($_GET['id']))//make sure we have an id in our url before getting here 
{
  $id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
  $query="SELECT * FROM posts WHERE id=$id";//post id
  $result=mysqli_query($connection,$query);
  $post=mysqli_fetch_assoc($result);
}
else{
  header('location: '.ROOT_URL . 'blog.php');
  die();
}
//NEW
?>
<style>
  #commentdisplay{
    display: none;
  }
 .commentbtn{
  margin-top: 1rem;
 }
 
 
  #comment-section{
    display: grid;
grid-template-columns: 1fr; /* posts are classified to 3 columns */
margin-bottom: 3vw;
width: 43vw;
    margin-left: 29vw;
    overflow-y: auto;
  }
  .comment {
    border: 1px solid #A0522D;
    /* padding: 10px; */
    padding-left: 0.2rem;
  
  
    margin-top: 0.5rem;
    background-color: #C19A6B;
    border-radius: 1rem;

    overflow-y: auto;
   
}
.comment h3 {
    font-size: 15px;
    margin: 0;
}
.comment p {
    font-size: 14px;
}
.par{
  color: teal;
  font-weight: 600;
}
.dislike
{
  background-color: red;
  width: 5rem;
  margin-left: 1rem;
  border-radius: 0.5rem;
}
.like
{
  background-color: green;
  width: 5rem;
  margin-left: 1rem;
  border-radius: 0.5rem;
}
.like:hover{
  background-color:white;
  transition:all 300ms ease; 
}
.dislike:hover
{
  background-color:white;
  transition:all 300ms ease; 

}
.save
{
  margin-left: 2rem;
  background-color: green;
  width: 4rem;
  border-radius: 1rem;
}
.save:hover
{
  background-color:lightblue;
  transition:all 300ms ease; 
}
</style>
<script>
  //Event Listener Timing: Ensure that your script runs after the DOM has fully loaded. You can wrap your code in a DOMContentLoaded event listener:
  document.addEventListener('DOMContentLoaded', () => {
  const comment=document.querySelector('#commentdisplay');
const showcommentBtn=document.querySelector('#show_comment-btn');
const hidecommentBtn=document.querySelector('#hide_comment-btn');
const showcomment=()=>{
  comment.style.display='grid';
  showcommentBtn.style.display='none'; //after clicked the show button changes with hide button
  hidecommentBtn.style.display='inline-block';
}
const hidecomment=()=>{
  comment.style.display='none';
  showcommentBtn.style.display='inline-block';
  hidecommentBtn.style.display='none';
}
showcommentBtn.addEventListener('click',showcomment);
hidecommentBtn.addEventListener('click',hidecomment);
});
  </script>
  <?php if(isset( $_SESSION['editcomment'])):?>
  <div class="alert__message error container" style="margin-top: 5rem;">
  <p><?= $_SESSION['editcomment'];//echo the not  successful method in its found in delete-category
  unset( $_SESSION['editcomment'])?></p></div>
  <?php endif?>
<?php
$userid=$_SESSION['user-id'];
$saved="SELECT * from saved_posts where post_id =$id and uid=$userid ";
$savedresult=mysqli_query($connection,$saved);
?>
<?php if(isset($_SESSION['saved'])):?>
 
 <div class="alert__message success container section_extra-margin">
   <p><?=$_SESSION['saved'];//echo the success method in $_SESSION['signup-success']its found innsignup logic
   unset($_SESSION['saved'])?></p>
 </div>
 <?php endif?>
<section class="singlepost">
  <div class="container singlepost_container">
    <h2><?=$post['title']?></h2>
           <div class="post__author">
            <?php
            //fetch author from user by using author id
$author_id=$post['author_id'];
$author_query="SELECT * FROM users WHERE id=$author_id";
$author_result=mysqli_query($connection,$author_query);
$author=mysqli_fetch_assoc($author_result);
$postlikes="SELECT * FROM post_votes WHERE post_id=$id";
$postlikex=mysqli_query($connection,$postlikes);
$postlike=mysqli_fetch_assoc($postlikex);
          ?>
            <div class="post__author_avatar">
            <a href="<?=ROOT_URL?>userposts.php?id=<?=$author['id']?>"> <img src="./images/<?=$author['avatar']?>" alt=""> </a><!-- author photo -->
            </div>
            <div class="post_author_info"><!-- author name and time of post -->
            <h5>By: <?= "{$author['firstname']} {$author['lastname']}"?></h5>
              <small> <?=date("M d,Y - H:i",strtotime($post['date_time']))//date it was posted?></small>
            </div>
         </div>
    <div class="singlepost_thumbnail">
      <img src="./images/<?=$post['thumbnail']?>" >
    </div>
    <p style="word-wrap:break-word;  white-space: normal;"><?=$post['body']?></p><!-- to make the words wrap to next line-->

    <form action="<?=ROOT_URL?>postvote.php?id=<?=$post['id']?>" method="post">
     <p> <button type="submit" class="like" name="postlike"> <i class="uil uil-thumbs-up"></i> : <?=$postlike['Likes']??null?></button>
     <button type="submit" class="dislike" name="postdislike"> <i class="uil uil-thumbs-down"></i>:<?=$postlike['Dislike']??null?> </button>
    <?php if(isset($_SESSION['user-id'])):?>
     <?php if(mysqli_num_rows($savedresult)==0):?>
   <button type="submit" class="save" name="save" ><i class="uil uil-save"></i></button>
   <?php else:?>
    <button type="submit" class="dislike" name="remove"><i class="uil uil-cancel"></i></button>
   <?php endif?>
   <?php endif?>
     </p>
    </form>
</div>
</section>


<section id="comment-section">
    <!-- Comments will be displayed here -->
    <form action="<?=ROOT_URL?>comment.php?id=<?=$post['id']?>"  method="post">
    <label for="comment" class="par">Comment:</label>
    <textarea id="comment" name="comment" required></textarea>
    <button type="submit" class="btn" name="submit">Submit Comment</button>
</form>
<?php
$get_comment="SELECT * FROM comments WHERE post_id=$id ORDER BY datetime DESC ";//recent post
$com=mysqli_query($connection,$get_comment);

?>
<?php if(mysqli_num_rows($com)>0):?>
<button id="show_comment-btn" style="margin-bottom: 0.7rem;" class="commentbtn btn"><i class="uil uil-comment-dots"></i></button>
<button id="hide_comment-btn" class="commentbtn btn"><i class="uil uil-comment-alt-check"></i></button>
<?php else:?>
  <h4>Be the first to comment</h4>
  <?php endif?>
<?php


if (!$com) {
  die("Query failed: " . mysqli_error($connection));
}
while($comment=mysqli_fetch_assoc($com)): ?>
    <div class="comment" id="commentdisplay">
   <?php
       $uid=$comment['user_id'];
       $get_commenter="SELECT * FROM users WHERE id=$uid ";
       $ex=mysqli_query($connection,$get_commenter);
       $uname=mysqli_fetch_assoc($ex);
       $cid=$comment['comment_id'];
       $likes="SELECT * FROM votes WHERE post_id=$id and comment_id=$cid";
       $likex=mysqli_query($connection,$likes);
       $like=mysqli_fetch_assoc($likex);
       ?>
                  <div class="post__author">
            <div class="post__author_avatar">
              <a style="margin-bottom: 0; margin-top:0;" href="<?=ROOT_URL?>userposts.php?id=<?=$uname['id']?>"><img src="./images/<?=$uname['avatar']?>" alt=""> </a><!-- author photo -->   <br> 
         
            </div>
            <div class="post_author_info"><!-- author name and time of post -->
              <small> <?=date("M d,Y - H:i",strtotime($comment['datetime']))//date it was posted?></small>
            </div>
          </div>
      
      
      
     
          <h3 style="margin-bottom: 0;"><?='@'.$uname['username']?></h3>
    <p style="margin-bottom: 0; margin-top:0;word-wrap:break-word;  white-space: normal;"><?=$comment['message']?></p>
  <form action="<?=ROOT_URL?>votes.php?id=<?=$post['id']?>&cid=<?=$comment['comment_id']?>" method="post" >
     <p> <button type="submit" class="like" name="likes"> <i class="uil uil-thumbs-up"></i>: <?=$like['Likes']??null?> </button>
      <button type="submit" class="dislike" name="dislike"><i class="uil uil-thumbs-down"></i>:  <?=$like['Dislikes']??null?>  </button>
      <button type="submit" class="like" name="edit"><i class="uil uil-comment-edit"></i> </button>
      <button type="submit" class="dislike" name="delete" > <i class="uil uil-trash-alt"></i></button>

     </p>
    </form>
         

</div>
<?php endwhile?>
</section>

<!--  ==============================================================================END OF SINGLEPOST=======================================
   -->
   <?php
include('./partials/footer.php');
  ?>
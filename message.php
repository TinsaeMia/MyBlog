<?php
require('config/database.php');
$Reciever=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
$sender=$_SESSION['user-id']??null;
$getmessge="SELECT * from messages where (sender_id=$sender and receiver_id=$Reciever) or (sender_id=$Reciever and receiver_id=$sender)";
$exgetmessge=mysqli_query($connection,$getmessge);

?>
<style>
body{
  background-color: #6B4226;
  
}
.message
{background-color: burlywood;
  border-radius: 2rem;
width: 50%;
height: fit-content;
max-width: 800px;
margin-left:25%;
min-width:10rem; 
  margin-top: 4%;
  margin-bottom: 4%;
 border: 5px solid lightblue;


}
.sending
{
  display: grid;
  grid-template-columns: 1fr ;
  gap: 0.5rem;


}
.sending p
{
  border: 1px solid lightblue;
  width: 96%;
  border-radius: 2rem;
  word-wrap:break-word;  white-space: normal;
  font-size: 1.0rem;
}
.img{
  border-radius: 50%50%;
  width: 2rem;
  height: fit-content;
}
.text
{
  margin-left: 1rem;
  background-color: grey;
  border-radius: 0.2rem;
color: white;
width:50%;

}
.btn
{ border-radius: 0.2rem;
  margin-bottom: 0.5rem;
 width:fit-content;
margin-left: 1rem;
 background-color: #4B362F;

 cursor: pointer;
 transition: all 300ms ease;
 font-weight: 600;
 color:lightseagreen;
}
.btn:hover{
  background: #f2f2fe;
  color:#0f0f3e;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<a href="<?=ROOT_URL?>userposts.php?id=<?= $Reciever?>" class="btn " style="margin-top: 5rem;margin-bottom: 0rem;">Back</a>
  <div class="message">
<div class="sending">
  <?php if(mysqli_num_rows($exgetmessge)>0):?>
    <?php while($fetchgetmessge=mysqli_fetch_assoc($exgetmessge)):?>
      <?php
      $senderid=$fetchgetmessge['sender_id'];
      $senduser="SELECT * FROM users where id=$senderid";
      $exsenduser=mysqli_query($connection,$senduser);
      $fetchsenduser=mysqli_fetch_assoc($exsenduser);

      ?>
  <p> <img class="img" src="./images/<?=$fetchsenduser['avatar']?>" alt="">&nbsp;&nbsp;
  <small><?=$fetchgetmessge['message']?> &nbsp;&nbsp;  <?=date("M d,Y - H:i",strtotime($fetchgetmessge['date_time']))//date it was posted?></small></p>

<?php endwhile?>
<?php endif?>
</div>
<div>

<form action="<?=ROOT_URL?>message-logic.php?id=<?=$Reciever?>"  method="post" style="margin-top: 12rem;">
  <p>  <label for="msg" class="par"></label>
    <textarea  id="msg" name="msg" required class="text" placeholder="message"></textarea>
    <button type="submit" class="btn" name="submit">send</button></p>
</form>
</div>
  </div>
</body>
</html>
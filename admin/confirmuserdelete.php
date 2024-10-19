<?php
include('C:/xampp/htdocs/blog/admin/partials/header.php');
$userid=$_GET['id'];
$query="SELECT * from users where id=$userid";
$result=mysqli_query($connection,$query);
$user=mysqli_fetch_assoc($result)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>confirm</title>

</head>
<body>
  <div class="confirm">
    <div class="content">
<h3>&nbsp;Do you want to Remove @<?=$user['username']?>?</h3>

<form action="<?=ROOT_URL?>admin/delete-user.php" method="post">

<button type="submit" class="confirmbtn confirmno">No. I changed my mind</button>
</form>
<form action="<?=ROOT_URL?>admin/delete-user.php?id=<?= $userid?>" method="post">
<button type="submit" class="confirmbtn confirmyes" name="submit">yes.Remove <?=$user['username']?></button>
</form>
</div>
  </div>
</body>
</html>
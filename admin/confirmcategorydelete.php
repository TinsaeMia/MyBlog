<?php
include('C:/xampp/htdocs/blog/admin/partials/header.php');
$categoryid=$_GET['id'];
$query="SELECT * from categories where id=$categoryid";
$result=mysqli_query($connection,$query);
$category=mysqli_fetch_assoc($result)
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
<h3>&nbsp;Do you want to Remove <?=$category['title']?>?</h3>

<form action="<?=ROOT_URL?>admin/manage-catagories.php" method="post">

<button type="submit" class="confirmbtn confirmno">No. I changed my mind</button>
</form>
<form action="<?=ROOT_URL?>admin/delete-category.php?id=<?= $categoryid?>" method="post">
<button type="submit" class="confirmbtn confirmyes" name="submit">yes.Remove <?=$category['title']?></button>
</form>
</div>
  </div>
</body>
</html>
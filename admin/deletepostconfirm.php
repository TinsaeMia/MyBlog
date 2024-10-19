<?php
include('C:/xampp/htdocs/blog/admin/partials/header.php');
$id=$_GET['id'];
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
<h3>&nbsp;Do you want to delete this post?</h3>

<form action="<?=ROOT_URL?>admin/index.php" method="post">

<button type="submit" class="confirmbtn confirmno">No. I changed my mind</button>
</form>
<form action="<?=ROOT_URL?>admin/delete-post.php?id=<?=$id?>" method="post">
<button type="submit" class="confirmbtn confirmyes" name="submit">yes.Delete the post</button>
</form>
</div>
  </div>
</body>
</html>
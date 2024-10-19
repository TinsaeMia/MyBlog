<?php
require('C:/xampp/htdocs/blog/admin/partials/header.php');
$id=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
$cid=filter_var($_GET['cid'],FILTER_SANITIZE_NUMBER_INT);
?> 



  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?=ROOT_URL?>editcomment.css">
  </head>
  <body>
  <form action="<?=ROOT_URL?>editcomment-logic.php?id=<?=$id?>&cid=<?=$cid?>"  method="post" class="edited">
    <label for="comment" class="par"> New Comment:</label>
    <textarea id="comment" name="comment"  class="msg" required></textarea>
    <button type="submit" class="btn" name="submit">Submit edited Comment</button>
  </body>
  </html>




</form>




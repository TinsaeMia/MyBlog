<?php
include('C:/xampp/htdocs/blog/admin/partials/header.php');

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
<h3>&nbsp;Do you want to delete your account?</h3>

<form action="<?=ROOT_URL?>admin/manage-self.php" method="post">

<button type="submit" class="confirmbtn confirmno">No. I changed my mind</button>
</form>
<form action="<?=ROOT_URL?>admin/deleteself.php" method="post">
<button type="submit" class="confirmbtn confirmyes" name="submit">yes.Delete my account</button>
</form>
</div>
  </div>
</body>
</html>
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
<h3>&nbsp;Do you really want to logout?</h3>



<a href="<?=ROOT_URL?>index.php"  class="confirmbtn confirmno">No. I changed my mind</button>

<a href="<?=ROOT_URL?>logout.php  " class="confirmbtn confirmyes" >yes.Log me out </a>

</div>
  </div>
</body>
</html>
<!-- access control is here .to check who should be loged in -->
<?php

require('C:/xampp/htdocs/blog/partials/header.php');//we cant access anything from admin until we signin

if(!isset($_SESSION['user-id']))
{  header('location: '.ROOT_URL . 'signin.php');//redirected
  die();

}
?>
<html>
  <head>   <link rel="stylesheet" href="<?=ROOT_URL?>CSS/stylesh.css" ></head>
</html>
<?php
require('config/database.php');
//fetch current user from db 
if(isset($_SESSION['user-id']))
{
  $id=filter_var($_SESSION['user-id'],FILTER_SANITIZE_NUMBER_INT);
  $query="SELECT avatar FROM users WHERE id=$id";
  $result=mysqli_query($connection,$query);
  $avatar=mysqli_fetch_assoc($result);
}
?>
<div id="header">
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home page</title>
  <!--  ICONSCOUT CDN -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<!--   <link rel="stylesheet" href="partials/stylesh.css" > -->
<link rel="stylesheet" href="<?=ROOT_URL?>CSS/stylesh.css" >

  <!--   google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> 
</head>

<body>

  <nav>
    <!--  i removed.container from here -->
    <div class=" container nav_container"> <!-- container class is on every setion -->
<!--     <a href="<?=ROOT_URL?>index.php" class="nav_logo " ><img src="<?=ROOT_URL?>Tukul2.webp"></a> -->
    <ul class="nav_items" >
     
    <li><a href="<?=ROOT_URL?>index.php">Home</a></li>
    <?php if(isset($_SESSION['user-id'])):?>
    <li><a href="<?=ROOT_URL?>myfeed.php">My feed</a></li>
    <?php endif?>
      <li><a href="<?=ROOT_URL?>blog.php">Search</a></li>
        <li><a href="<?=ROOT_URL?>about.php">About</a></li>
        <!-- <li><a href="<?=ROOT_URL?>services.php">Services</a></li> -->
        <li><a href="<?=ROOT_URL?>contact.php">Contact</a></li>
        <?php if(isset($_SESSION['user-id'])):?> <!--check if user is loged in or signed in -->
          <li class="nav__profile"><!--when signin is complete,thw signin text will be . replaced by the users avatar  --> 
          <div class="avatar">
            <img src="<?=ROOT_URL. 'images/' . $avatar['avatar']?>"> 
          </div>
          <ul>
            <li><a href="<?= ROOT_URL?>admin/index.php">Dashboard</a></li>
            <li><a href="<?= ROOT_URL?>admin/confirmlogout.php">Logout</a></li>
          </ul>
        </li>
        <?php else : ?>
           <li><a href="<?= ROOT_URL?>signin.php">Signin</a></li> 
<?php endif?>
      </ul>
      <button id="open_nav-btn"> <i class="uil uil-bars"></i><!-- add icone --></button><!-- used when page is in small screen -->
      <button id="close_nav-btn"> <i class="uil uil-multiply"></i><!-- add icone --></button>
    </div>
  </nav>
  <!--   -------------------------End of Nav-------------------- --></div>
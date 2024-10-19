<?php
//include('C:\xampp\htdocs\blog\partials\header.php');
include('config/constants.php');
$username_email=$_SESSION['signin-data']['username-email']??null;
$password=$_SESSION['signin-data']['password']??null;
unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in page</title>
  <!--  ICONSCOUT CDN -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <link rel="stylesheet" href="<?=ROOT_URL?>CSS/stylesh.css" >
  <!--   google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> 
</head>

<body>

<section class="form__section">
  <div class="container form__section-container">
    <h2>Sign In</h2>
    <?php
 //check if signup session is set
 if(isset($_SESSION['signup-success'])):?>
 
    <div class="alert__message success">
      <p><?=$_SESSION['signup-success'];//echo the success method in $_SESSION['signup-success']its found innsignup logic
      unset($_SESSION['signup-success'])?></p>
    </div>
    <?php elseif(isset($_SESSION['signin'])):?>
    <div class="alert__message error">
    <p><?=$_SESSION['signin'];//echo
    unset($_SESSION['signin']);?></p>
  </div>
  <?php elseif(isset($_SESSION['connection'])):?>
  <div class="alert__message error">
  <p><?=$_SESSION['connection'];
    unset($_SESSION['connection'])//delete it?></p>
</div>
<?php elseif(isset($_SESSION['vote'])):?>
<div class="alert__message error">
<p><?=$_SESSION['vote'];
  unset($_SESSION['vote'])//delete it?></p>
</div>
<?php elseif(isset($_SESSION['postlike'])):?>
  <div class="alert__message error">
  <p><?=$_SESSION['postlike'];
    unset($_SESSION['postlike'])//delete it?></p>
</div> 
<?php elseif(isset($_SESSION['follow'])):?>
<div class="alert__message error">
<p><?=$_SESSION['follow'];
  unset($_SESSION['follow'])//delete it?></p>
</div>
<?php elseif(isset($_SESSION['myfeed'])):?>
  <div class="alert__message error">
  <p><?=$_SESSION['myfeed'];
    unset($_SESSION['myfeed'])//delete it?></p>
</div> 
  <?php endif?>
    <form action="<?=ROOT_URL?>signin-logic.php" method="post" enctype="multipart/form-data"> <!-- enctype is required for forms with file input -->
      <input type="text"  name="username_email" value="<?=$username_email?>" placeholder="Username or Email">
      <input type="password" name="password" value="<?=$password?>" placeholder="Password">
      <button type="submit" name="submit" class="btn">Sign In</button>
      <small>Don't have an account?<a href="signup.php">Sign Up</a></small>
      
  
    </form>
  </div>
</section>
</body>
</html>

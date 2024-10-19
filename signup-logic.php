<?php

include('config/database.php');
//get sinup form data if signup button was clicked
if(isset($_POST['submit']))//if sumbit is pressed
{
  $firstname=filter_var($_POST['firstname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);//SO NOONE INJECTS SQL INPUT
  $lastname=filter_var($_POST['lastname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $username=filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email=filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);//TO MAKE SURE ITS AN ACTUALL EMAIL
  $createpassword=filter_var($_POST['createpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $confirmpassword=filter_var($_POST['confirmpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $avatar=$_FILES['avatar'];//to ger file use FILESsuper global
//validate input 
if(!$firstname)
{
  $_SESSION['signup']="please enter your First Name";//we wanna access it on a different page(on signup)
}
elseif(!$lastname)
{
$_SESSION['signup']="please enter your Last Name";
}
elseif(!$username){
  $_SESSION['signup']="please enter your  User Name";
}
elseif(!$email){
  $_SESSION['signup']="please enter a valid  Email";
}
elseif(strlen($createpassword)<8 ||strlen($confirmpassword)<8 ){
  $_SESSION['signup']="password should be 8+ character";
}
elseif(!$avatar['name']){//if we dont select an avatar we woulddnt have a name for it 
  $_SESSION['signup']="please add avatar";} 
  else{
    //check if passwords in create and confirm match
if($createpassword!==$confirmpassword)
    {$_SESSION['signup']="Passwords don't match";
    }
   
    else{
      //hash password
      $hashed_password=password_hash($createpassword,PASSWORD_DEFAULT);
//check if username or email alreadfy exists in the data base
$user_check_query="SELECT * FROM users WHERE
username='$username' OR email='$email'";
$user_check_result=mysqli_query($connection,$user_check_query);//if we get any raws from the Db
if(mysqli_num_rows($user_check_result)>0)
{
   $_SESSION['signup']="Username or Email already exist";
}
else{//someone could have the same name when they upload an imageso we want to rename theimages foreach upload
  //work on avatar
  $time=time();//cant repeat.same as math.random
  $avatar_name=$time . $avatar['name'];
  $avatar_tmp_name=$avatar['tmp_name'];
  $avatar_destination_path='images/'.  $avatar_name;
//make sure the file is an image
$allowed_files=['png','jpg','jpeg'];
$extension= explode('.',$avatar_name);
$extension=end($extension);//getting extension
if(in_array($extension,$allowed_files))
{
  //make sure image is not too large(1mb+)
  if($avatar['size']<1000000)//1megabyte
  {//upload image
    move_uploaded_file($avatar_tmp_name,$avatar_destination_path);
  
  }
  else{
    $_SESSION['signup']='File size too big.should be less than 1mb';
  }
}else{//if the file is not an image 
  $_SESSION['signup']='File should be png,jpg,or jpeg';
}

}
    }
  }
//redirect into signup page if any problem
if(isset($_SESSION['signup']))
{
  //pass the form data back too signup page
  $_SESSION['signup-data']=$_POST;//SEND ALL THE INVALID DETAILES BACK TO THESIGNUP PAGE
  header('location: '.ROOT_URL . 'signup.php');
}
else{
  //insert new user into users table
  $insert_user_query="INSERT INTO users SET firstname='$firstname',lastname='$lastname',username='$username',email='$email',password='$hashed_password',avatar='$avatar_name',is_admin=0";

  $insert_user_result=mysqli_query($connection, $insert_user_query);
  $fid="SELECT * from users where username='$username' ";
  $fr=mysqli_query($connection, $fid);
  $fassoc=mysqli_fetch_assoc($fr);
  $foid=$fassoc['id'];
  $f="INSERT INTO user_followers SET follower_count=0,user_id=$foid,following_count=0";
  $fresult=mysqli_query($connection, $f);
if(!mysqli_errno($connection))
{
  //redirect to login page with success message
  $_SESSION['signup-success']="Registration successful. Please log in";
  header('location: '.ROOT_URL . 'signin.php');
  die();
}
}
}else{
  //if button was not clicked bounce to signup page
  header('location:' . ROOT_URL . 'signup.php');
  die();
}

?>
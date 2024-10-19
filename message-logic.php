<?php
require('config/database.php');
$Reciever=filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
$sender=$_SESSION['user-id']??null;
$msg=$_POST['msg'];
$send="INSERT INTO messages SET sender_id=$sender,receiver_id=$Reciever,message='$msg'";
$sendresult=mysqli_query($connection, $send);
header('location: '.ROOT_URL . 'message.php?id='.$Reciever);
die();
?>
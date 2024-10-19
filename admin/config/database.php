<?php
require('C:\xampp\htdocs\blog\admin\config\constants.php');
//connect to DB------------
$connection=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
if(mysqli_errno($connection))//if there is error it tells
{
die(mysqli_error($connection));
}
?>
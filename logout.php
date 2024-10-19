<?php
require('config/constants.php');
session_destroy();
//destroy all session and redirect user to home page
header('location: '.ROOT_URL );
die();

?>
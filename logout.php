<?php

session_start();
session_destroy();
header('location: login.php');
setcookie('remember_user','',time() - (60*60*24));
setcookie('remember_password','',time() - (60*60*24));
?>
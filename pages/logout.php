<?php
require '../dbconnect.php';
//stops all sessions and cookies
session_start();
session_unset();
session_destroy();
setcookie('email', $_cookie['email'], -1, '/');
header('location: ../index.php');

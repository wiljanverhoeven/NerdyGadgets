<?php
require '../dbconnect.php';

session_start();
session_unset();
session_destroy();
setcookie('email', $_cookie['email'], -1, '/');
header('location: ../index.php');

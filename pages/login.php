<?php

require '../dbconnect.php';
require '../logic/functions.php';

//gathers data from the form to log in

if (isset($_POST["apply"])) {

    $mail = $_POST["mail"];
    $pwd = $_POST["pass"];

    loginUser($conn, $mail, $pwd);
}

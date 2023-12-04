<?php

require '../dbconnect.php';
require '../logic/functions.php';



if (isset($_POST["apply"])) {

    $mail = $_POST["mail"];
    $pwd = $_POST["pass"];

    loginUser($conn, $mail, $pwd);
}

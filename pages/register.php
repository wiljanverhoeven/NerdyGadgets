<?php
    require '../dbconnect.php';
    require '../logic/functions.php';


if (isset($_POST["apply"])) {
    $Fname = $_POST["name"];
    $prefix = $_POST["prefix"];
    $Lname = $_POST["Lname"];
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];
    $street = $_POST["street"];
    $HNM = $_POST["HNM"];
    $Pcode = $_POST["Pcode"];
    $city = $_POST["city"];

    $check = "SELECT email FROM user WHERE email = ?";
    $stmt = $conn->prepare($check) or die("prepare failed.");
    $stmt->bind_param('s', $mail);
    $stmt->execute() or die('email exists failed');
    $resultSet = $stmt->get_result();
    $row = $resultSet->fetch_all();


    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } elseif (PostcodeCheck($Pcode) === false) {
        echo "Invalid postalcode format";
    } elseif ($row == true) {
        echo "email is already in use";
    } else {
        createuser($conn, $Fname, $prefix, $Lname, $mail, $pass, $street, $HNM, $Pcode, $city);
    }
}


?>

<?php

function usernameExists($conn, $mail){
    $query = "SELECT * FROM users WHERE username = ?;";
    $stmt = $conn->prepare($query) or die ("prepare failed.");

    $stmt->bind_param('s', $name);

    $stmt->execute() or die ('username exists failed');
    
    $resultSet = $stmt->get_result();

    if ($row = $resultSet->fetch_all()) {
        return $row;

    }
    else {
        return false;
    }

    $conn = null;
    $stmt = null;
}

function createUser($conn, $Fname, $prefix, $lname, $mail, $pass, $street, $HNM, $Pcode, $city){
    $query = "INSERT INTO user (first_name, surname_prefix, surname, email, password, street_name, apartment_nr, postal_code, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($query) or die ("prepare failed.");

    $hashedpwd = hash('sha512', $pass);

    $stmt->bind_param('sssssssss',$Fname, $prefix, $lname, $mail, $hashedpwd, $street, $HNM, $Pcode, $city);
    
    session_start();
    header('location: ../index.php');

    $stmt->execute() or die ('execution failed.');
    $conn = null;
    $stmt = null;
}

function loginUser($conn, $mail, $pwd) {
    $userExists = usernameExists($conn, $mail, $mail);

    $DBPwd = $userExists[0][2];
    $hashedPwd = hash('sha512', $pwd);

    if ($hashedPwd == $DBPwd) $checkPwd = true;
    else $checkPwd = false;

    if ($checkPwd === false) {
        echo "password is incorrect";
        exit();
    }
    else if ($checkPwd) {
        session_start();
        setcookie('username', $userExists[0][1], 0, '/');
        header('location: ../index.php');
        exit();
    }
}

?>
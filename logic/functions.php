<?php

function mailExists($conn, $mail){
    $query = "SELECT * FROM user WHERE email = ?;";
    $stmt = $conn->prepare($query) or die ("prepare failed.");

    $stmt->bind_param('s', $mail);

    $stmt->execute() or die ('email exists failed');
    
    $resultSet = $stmt->get_result();

    if ($row = $resultSet->fetch_all()) {
        return $row;

    }
    else {
        return false;
    }

}

function createUser($conn, $Fname, $prefix, $lname, $mail, $pass, $street, $HNM, $Pcode, $city){
    $query = "INSERT INTO user (first_name, surname_prefix, surname, email, password, street_name, apartment_nr, postal_code, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($query) or die ("prepare failed.");

    $hashedpwd = hash('sha512', $pass);

    $stmt->bind_param('sssssssss',$Fname, $prefix, $lname, $mail, $hashedpwd, $street, $HNM, $Pcode, $city);
    
    session_start();
    setcookie('email', $mail, 0, '/');
    header('location: ../index.php');

    $stmt->execute() or die ('execution failed.');
    $conn = null;
    $stmt = null;
}

function loginUser($conn, $mail, $pwd) {
    $userExists = mailExists($conn, $mail);


    if ($userExists === false) {
        echo "user doesnt exist";
        exit();
    }

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
        setcookie('email', $userExists[0][1], 0, '/');
        header('location: ../index.php');
        exit();
    }
}

?>
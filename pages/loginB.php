<?php
//sending user info to database
$username = $_POST['usernamelogin'];
$password = $_POST['passwordlogin'];
$Email = $_POST['Email'];

//database
$conn =new mysqli('localhost', 'root', '', 'registration');
if ($conn->connect_error){
    die('connection failed : '.$conn->connect_error);
}
else{
    $stmt = $conn->prepare('insert into registration(usernamelogin, passwordlogin, Email) values(?,?,?)');
    $stmt->bind_param("sss", $username, $password, $Email);
    $stmt->execute();
    echo "registration succesful";
    $stmt->close();
    $conn->close();
}




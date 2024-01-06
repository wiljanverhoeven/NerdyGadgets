<?php

//defined variabelen voor de database connectie
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "mydb";

//connectie met de database
$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

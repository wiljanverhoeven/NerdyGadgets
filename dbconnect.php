<?php

//defined variabelen voor de database connectie
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "mydb"; //als je naam van de database is veranderd hier ook de naam veranderen

//connectie met de database
$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

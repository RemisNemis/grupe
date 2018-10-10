<?php

$servername = 'localhost';
$username = 'root';
$password = '123';

// Prisijungiam prie serverio
$conn = mysqli_connect($servername, $username, $password);

// Patikrinam prisijungimą
if (!$conn) {
   die('Connection failed: ' . mysqli_connect_error());
}

// Sukuriam duomenų bazę
$sql = "CREATE DATABASE IF NOT EXISTS user_manager";
if (mysqli_query($conn, $sql)) {
   echo "Database created successfully";
} else {
   echo "Error creating database: " . mysqli_error($conn);
}
//Uždarom prisijungimą
mysqli_close($conn);

// Prisijungiam prie serverio
$conn = mysqli_connect($servername, $username, $password, 'user_manager');

// Patikrinam prisijungimą
if (!$conn) {
   die('Connection failed: ' . mysqli_connect_error());
}

mysqli_query($conn, 'DROP TABLE IF EXISTS `users`');

$sql = "CREATE TABLE users(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    pass VARCHAR(191),
    reg_date TIMESTAMP
    )";
   
    if (mysqli_query($conn, $sql)) {
        echo "Table users created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
 
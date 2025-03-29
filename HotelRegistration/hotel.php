<?php

include("login.php"); 

// Connect to MySQL without selecting a database first
$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it does not exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS hotel_database";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully (or already exists).<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// **Select the correct database**
$conn->select_db("hotel_database");

// Create the table if it does not exist
$sql = "CREATE TABLE IF NOT EXISTS hotelregistration (
    id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(30) NOT NULL,
    passport VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    arrival DATETIME NOT NULL,
    departure DATETIME NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'hotelregistration' created successfully (or already exists).<br>";
} else {
    die("Error creating table: " . $conn->error);
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>
    <body>
        <style>
            h1 {
                font-size:20px;
            }
        </style>
        <h1>Register</h1>
        <form action="" method="POST">
            <h1>What's your name?</h1>
            <input type="text" name="fullname" placeholder="Write your full name here">

            <h1>What's your passport?</h1>
            <input type="text" name="passport" placeholder="Write your ID/passport here">

            <h1>When will you arrive?</h1>
            <input type="date" name="arrivedate">

            <h1>When will you depart?</h1>
            <input type="date" name="depdate"><br>

            <input type="submit" name="reserve">
        </form>
    </body>
</html>

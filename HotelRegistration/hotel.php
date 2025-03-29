<?php

include("login.php"); 

// Connect to MySQL without selecting a database first
$conn = new mysqli($host, $user, $password);

//if connection failed kill the program, throw exception
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database 
$sql_create_db = "CREATE DATABASE IF NOT EXISTS hotelregistration";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully (or already exists).<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the correct database
$conn->select_db("hotelregistration");

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

//query
if ($conn->query($sql) === TRUE) {
    echo "Table 'hotelregistration' created successfully (or already exists).<br>";
} else {
    die("Error creating table: " . $conn->error);
}

//Inserting a guest into the database through accessing the posted values from the form
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fullname"]))
{
    $sql_add_guest="INSERT INTO hotelregistration(fullname, passport, email, arrival, departure) VALUES
    ('".$_POST["fullname"]."','".$_POST["passport"]."','".$_POST["email"]."','".$_POST["arrivedate"]."','".$_POST["depdate"]."')";
    
    $conn->query($sql_add_guest);
}

//Showing reservations
$sql_select="SELECT * FROM hotelregistration";
$table=$conn->query($sql_select);

echo "<table border=1>";
    echo "<tr>";
    while($fieldinfo=$table->fetch_field())
    {
        echo "<th>".$fieldinfo->name."</th>";
    }
    echo "</tr>";
    if($table->num_rows>0)
    {
        while($record=$table->fetch_assoc())
        {
            echo "<tr>";
            foreach($record as $data)
            {
                echo "<th>".$data."</th>";
            }
            echo "</tr>";
        }
    }
    
echo "</table>";


//closeing connection (otherwise wont run)
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

            <h1>What's your email address?</h1>
            <input type="text" name="email" placeholder="Write your email here">

            <h1>When will you arrive?</h1>
            <input type="date" name="arrivedate">

            <h1>When will you depart?</h1>
            <input type="date" name="depdate"><br>

            <input type="submit" value="reserve">
        </form>
    </body>
</html>

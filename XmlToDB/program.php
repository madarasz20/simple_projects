<?php

// creating the DB
include("login.php");

$conn= new mysqli($host,$user,$password);

if($conn->connect_error)
{
    die("connection falied: ".$conn->connect_error."<br>");
}
else
{
    echo "Connection success"."<br>";
}

$sql_create_db= "CREATE DATABASE IF NOT EXISTS fromXml";
if($conn->query($sql_create_db))
{
    echo "database created succesfully"."<br>";
}
else
{
    die ("error creating database: ". $conn->error."<br>");
}

$conn->select_db("fromXml");

//creating the table
$sql_db_table="CREATE TABLE IF NOT EXISTS zoo (
    id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    origin VARCHAR(30) NOT NULL,
    carnivorous VARCHAR(30) NOT NULL

)";

if($conn->query($sql_db_table))
{
    echo "TABLE created succesfully"."<br>";
}
else
{
    die ("error creating database: ". $conn->error."<br>");
}

//xml loading


if(!file_exists('inputXML.xml'))
{
    die("XML doesnt exisst");
}
else
{
    $xmlContent=simplexml_load_file('inputXML.xml');
    foreach($xmlContent->animal as $animal)
    {
        $id = (int)$animal['id'];
        $name = (string) $animal->name;
        $origin = (string) $animal->origin;
        $carnivorous= (string)$animal->carnivorous;

        $sql = "INSERT INTO zoo (id, name, origin, carnivorous)
                    VALUES ('$id', '$name', '$origin', '$carnivorous')";

        if($conn->query($sql))
        {
            echo "animal $id inserted to DB"."<br>";
        }
        else
        {
            echo "Error";
        }
    }

    $conn->close();
}

?>
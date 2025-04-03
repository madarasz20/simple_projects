<?php

//1. load the xml
//2. create an array from the xml
//3. create a DB for the xml values
//4. insert the values into the DB

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

$sql_db_table="CREATE TABLE IF NOT EXISTS fromXml (
    id INT(3) UNSIGNED AUTO_iNCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    origin VARCHAR(30) NOT NULL,
    carnivourus BOOLEAN NOT NULL

)";

if($conn->query($sql_db_table))
{
    echo "TABLE created succesfully"."<br>";
}
else
{
    die ("error creating database: ". $conn->error."<br>");
}


//1.
//xml loading

$xmlArray=[];
if(!file_exists('inputXML.xml'))
{
    die("XML doesnt exisst");
}
else
{
    $xmlContent=simplexml_load_file('inputXML.xml');
    foreach($xmlContent->children() as $child)                      //loads the animals
    {
        $array=$child->children();                                  //loads the name, origin, carnivorous values
        $childname=$child->getName();
        

        foreach($array as $subChild)
        {
            //insert into DB here
            echo $subChild->getName(). ":" . $subChild."<br>";
        }
    }
}

?>
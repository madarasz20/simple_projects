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

$sql_create_db= "CREATE DATABASE IF NOT EXISTS zoo";
if($conn->query($sql_create_db))
{
    echo "database created succesfully"."<br>";
}
else
{
    die ("error creating database: ". $conn->error."<br>");
}

$conn->select_db("zoo");
//dynamically creating DB from the xml

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
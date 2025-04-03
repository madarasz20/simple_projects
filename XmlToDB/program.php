<?php

//1. load the xml
//2. create an array from the xml
//3. create a DB for the xml values
//4. insert the values into the DB

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
            //insert into DB
            echo $subChild->getName(). ":" . $subChild."<br>";
        }


    }
}




?>
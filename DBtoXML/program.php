<?php

$host="localhost";
$user="root";
$password="";

$conn= new mysqli($host, $user, $password);

if($conn->connect_error)
{
    die("Conncetion error".$conn->connect_error);
}
else
{
    echo "database connected";
}

$conn->select_db("fromXml");

$sql_select = "SELECT * FROM zoo";

$result = $conn->query($sql_select);

if(!$result)
{
    die("query error");
}
else
{
    echo "query done";
}

$xml = new SimpleXMLElement("<root/>");

while ($row = $result->fetch_assoc()) {
    $item = $xml->addChild("item");
    
    foreach ($row as $key => $value) {
        $item->addChild($key, htmlspecialchars($value));
    }
}

$xml->asXML("output.xml");  // Save to file



?>
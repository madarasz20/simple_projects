<?php
function xmlToArray($xml) {
    // initialise jsonArray
    $jsonArray = [];

    // Loops through the attributes of the xml tag, then store them in "$jsonArray"
    foreach ($xml->attributes() as $attrKey => $attrValue) {                    //xml->attributes() gets the attributes of the tag
        $jsonArray['_attributes'][$attrKey] = (string) $attrValue;
    }

    // Process child elements, store them in "$childArray"
    foreach ($xml->children() as $child) {                                      //xml->children() gets the child elements of the XML Node
        $childArray = xmlToArray($child);
        $childName = $child->getName();

        if (!isset($jsonArray[$childName])) {
            $jsonArray[$childName] = $childArray;                               //if the current child is not stored inthe json, add it
        } else {
            if (!is_array($jsonArray[$childName]) || !isset($jsonArray[$childName][0])) {       // if the child already exists, it converts it to an array         
                $jsonArray[$childName] = [$jsonArray[$childName]];
            }
            $jsonArray[$childName][] = $childArray;
        }
    }

    // Process text values
    $text = trim((string) $xml);                //takes out the whitespace
    if (!empty($text)) {                        
        $jsonArray['_value'] = $text;           //stores it under values in the jsonarray
    }

    return $jsonArray;
}

function convertXmlToJson($xmlFile, $jsonFile) {
    if (!file_exists($xmlFile)) {
        die("XML file not found.");
    }

    $xmlContent = simplexml_load_file($xmlFile);                    //loads xml
    $jsonArray = xmlToArray($xmlContent);                           // creates json array from xml
    $jsonOutput = json_encode($jsonArray, JSON_PRETTY_PRINT);       // encodes json array as json file

    file_put_contents($jsonFile, $jsonOutput);                      //writes data from "$jsonOutput" to "$jsonFile"
    echo "JSON file created successfully: $jsonFile\n";
}

// Usage
$xmlFile = 'input.xml';         //input xml file
$jsonFile = 'output.json';      //output json file
convertXmlToJson($xmlFile, $jsonFile);
?>

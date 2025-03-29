
<?php
//xampp control panel v3.3.0 apache MySQL module running
//in browser: http://localhost/ToDOApp_php/main.php

session_start();            // php session stores information in variables through pages


if(!isset($_SESSION["things"]))         //checks if the variable is set
{
    $_SESSION["things"] = array();              // initializes array for the session
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["send"]))           //$server is a superglobal, holds info from the html form 
{                                                                           // if thre request method from the form is post (update) and send input field is not empthy
    $new_task= trim($_POST["szoveg"]);                                      // trim removes whitespace
    if(!empty($new_task))
    {
        array_push($_SESSION["things"], $new_task);                         // push it into the session array "things"
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {      // if the https post is set
    $index = $_POST["delete"];                                              //gets the array of variables from delete 
    if (isset($_SESSION["things"][$index])) {
        array_splice($_SESSION["things"], $index, 1);                       // deletes the latest addition from "things" 
    }
}
 
?>
<!DOCTYPE html>
<html>
    <body>
        <form action="" method="POST">                                  
        <h1>This is a ToDo app</h1>
        <input type="text" name="szoveg"></input><br>
        <input type="submit" name="send" value="send"></input>
        </form>


        <h2>ToDO List</h2>
        <ul>
        <?php
            if (!empty($_SESSION["things"])) {
                foreach ($_SESSION["things"] as $index => $t) {
                    echo "<li>" . htmlspecialchars($t) . "                      
                        <form action='' method='POST' style='display:inline;'>
                            <button type='submit' name='delete' value='$index'>Delete</button>
                        </form>
                    </li>";
                }                                                                               // htmlspecialcharacters converts "<,>" to html entities
            }
            ?>
        </ul>
    </body>  

</html>
   
<html>
    <body>
        <form action="" method="POST">
            <h1> Admin Meetings </h1>
            <h1> Create new meeting </h1>
            <input type="date" name="time">enter the time</input><br>
            <h1> Whats it for? </h1>
            <input type="text" name="purpose">enter purpose</input><br>
            <input type="submit" name="newmeeting" value="New Meeting"></input><br>
                        
        </form>
       

    </body>
</html>   

<?php
$db = new PDO('sqlite:appointment_making_db.db');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["purpose"]) && isset($_POST["time"]))
{

    $purpose = $_POST["purpose"];
        $meeting_time = $_POST["time"];
    
        $sql_insert = "INSERT INTO meetings (purpose, meeting_time) VALUES (:purpose, :meeting_time)";
        
        $stmt = $db->prepare($sql_insert);
        
        $stmt->bindParam(':purpose', $purpose, PDO::PARAM_STR);
        $stmt->bindParam(':meeting_time', $meeting_time, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            echo "Meeting added successfully!";
        } else {
            echo "Error: Could not add meeting.";
        }
}

$db = new PDO('sqlite:appointment_making_db.db');

$select = "SELECT * FROM meetings";
$prep = $db->prepare($select);
$prep->execute();  

$arr = $prep->fetchAll(PDO::FETCH_ASSOC);


$db = null;

if (count($arr) > 0) {
    echo "<table border='1'>";
    echo "<thead>";
    echo "<tr><th>ID</th><th>Purpose</th><th>Meeting Date</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($arr as $meeting) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($meeting['id']) . "</td>";
        echo "<td>" . htmlspecialchars($meeting['purpose']) . "</td>";
        echo "<td>" . htmlspecialchars($meeting['meeting_time']) . "</td>";
        echo "<td><button onclick='deleteMeeting()'>Delete meeting</button></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "<p>No meetings recorded</p>";
}

function deleteMeeting()
{
    $db = new PDO('sqlite:appointment_making_db.db');

    $sql_del = "DELETE FROM meetings WHERE id = :id;";
    $db-> prepare($sql_del);
    $db-> exec($sql_del);
    $db= null;

}


?>
<?php

$db = new PDO('sqlite:appointment_making_db.db');

$sql_user_table="CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role TEXT NOT NULL,
    login_time TEXT NULL     
)";

if(!$db->exec($sql_user_table))
{
    echo "user table created"."<br>";
}else{
    die("user table failed to create"."<br>");
}

$meeting_table_create="CREATE TABLE IF NOT EXISTS meetings (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    meeting_time TEXT NULL,
    purpose TEXT NOT NULL

)";



if(!$db->exec($meeting_table_create))
{
    echo "meeting table created"."<br>";
}else{
    die("meeting table failed to create"."<br>");
}


$sql_both_table="CREATE TABLE IF NOT EXISTS meetingswithusers (
    meeting_id INTEGER,
    user_id INTEGER,
    FOREIGN KEY(user_id) REFERENCES users(id),
    FOREIGN KEY(meeting_id) REFERENCES meetings(id)
)";


if(!$db->exec($sql_both_table))
{
    echo "connector table created"."<br>";
}else{
    die("connector table failed to create"."<br>");
}

$users = [
    ['admin', 'admin', 'admin'],
    ['Jani', 'pass', 'user'],
    ['Juli', 'pass', 'user'],
    ['Piroska', 'pass', 'user'],
    ['Erik', 'pass', 'user'],
    ['Maris', 'pass', 'user'],
];

foreach ($users as $user) {
    $stmt = $db->prepare("INSERT OR IGNORE INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$user[0], password_hash($user[1], PASSWORD_DEFAULT), $user[2]]);
}

//header("Location: loginpage.php");

?>

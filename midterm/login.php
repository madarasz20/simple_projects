<?php
session_start();

try {
    $db = new PDO('sqlite:appointment_making_db.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            $db= new SQLite3('appointment_making_db.db');
            $sql= "INSERT INTO users (login_time) VALUES (CURRENT_TIMESTAMP)";
            $db->exec($sql);
            if ($user['role'] === 'admin') {

                header("Location: admin_meeting_timetable.php");
            } else {
                header("Location: user_meeting_timetable.php");
            }
        
            exit();
        } else {
            echo " Invalid login credentials.";
        }
    }
} catch (PDOException $e) {
    echo " DB Error: " . $e->getMessage();
}
?>

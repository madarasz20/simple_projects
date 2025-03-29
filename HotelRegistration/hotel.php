<?php

?>

<!DOCTYPE html>
<html>
    <body>
        <style>
            h1 {
                font-size:20px;
            }
        </style>
        <h1>Register</h1>
        <form action="" method="POST">
            <h1 >Whats your name?<h1>
                <input type="text" name="fullname" value="write your full name here"></input>
            <h1>Whats your ID?<h1>
                <input type="text" name="id" value="write your id/passport here"></input>
            <h1>When will you arrive?<h1>
                <input type="date" name="arrivedate" value="set the arrival date"></input>
            <h1>When will you depart?<h1>
                <input type="date" name="depdate" value="set the departuredate"></input><br>
                <input type="submit" name="reserve"></input>
        </form>
    </body>

</html>
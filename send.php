<?php
include 'config.php';
$user = htmlspecialchars($_POST["username"]);
$score = htmlspecialchars($_POST["myfinalscore"]);

$sql = "INSERT INTO leaderboard (name, score) VALUES ('".$user."', ".$score.")";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
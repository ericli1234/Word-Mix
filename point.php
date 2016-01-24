<?php
$time = $_POST["time"];
session_start();
$pass = $_SESSION["pass"];
$score = -$time*2 + $pass*60;
if($score < 0){
    $score = 0;
}
echo $score;
?>
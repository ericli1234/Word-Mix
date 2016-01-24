<?php
$questions = [
        "Uber",
        "Hot",
        "Best University",
        "Sleep in a Can",
        "Electronic post",
        "Cold Cat",
        "Seaweed wrap",
        "H2O",
        '<embed src="mario.mp3" id="mario" autostart="true" loop="true" width="2" height="0"></embed>Turn Up your Volume <3',
        "fin"
        
    ];
        session_start();
        $_SESSION["question"]++;
        echo($questions[$_SESSION["question"]]);
?>
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
        '<embed id="mario" src="mario.mp3" autostart="true" loop="true" width="2" height="0"></embed>Turn Up your Volume <3',
        "fin"
        
    ];
    
    $answers = [
        "taxi",
        "cold",
        "uoft",
        "redbull",
        "email",
        "hotdog",
        "sushi",
        "water",
        "mario",
        "fin"
    ];

    session_start();
    
    $guess = htmlspecialchars($_POST["guess"]);
  //  $_SESSION["points"] = 	$_SESSION["points"] + 50;
    $answer = $answers[$_SESSION["question"]];
    
     if (preg_replace("/[^A-Za-z0-9]/",'', strtolower($guess)) == $answer) {
        $_SESSION["pass"] = $_SESSION["pass"]+1;
        $_SESSION["question"]++;
        echo($questions[$_SESSION["question"]]);
    }
?>

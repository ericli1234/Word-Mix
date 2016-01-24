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
	$_SESSION["question"] = 0;
	$_SESSION["pass"] = 0;
?>

<!DOCTYPE HTML>
<html class="html">
    <head>
        <title>Word Mix</title>
        <meta charset="utf 8">
        
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        
        <!--Bootstrap-->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="style.css"/>
		
    </head>
 
	<script>
	    $(document).ready(function(){
	    	var hrwidthtimer = window.setInterval(function () {
                
                var hrwidth = $("#othertitlehr").width();
                
                if(hrwidth < 200){
                	
                    $('#othertitlehr').css("width",hrwidth+2);
                }else{
                    window.clearTimeout(hrwidthtimer);
                }
            });
	    	
	    	//$(".title").fadeIn(600);
	    	//$("#instructions").fadeIn(800);
	    	$("#startgame").fadeIn(800);
	    	$("#title").fadeIn(800);
	    	//$("#instruction-title").fadeIn(800);
	    	
	    	
	    	//to stop giving out errors before pressing the game
	    	var started = 0;
	    	var shakeanimation = false;
	    	var ended = false;
	    	var myfinalscore = 0;
	    	
	    	function shakeForm() {
	    		
	    		if(shakeanimation == false){
	    		
	    			shakeanimation = true;
			   		var l = 20;  
				   	for( var i = 0; i < 8; i++ ){
				     	$("#response").animate({
				         	'margin-left': "+=" + ( l = -l ) + 'px',
				         	'margin-right': "-=" + l + 'px'
				      	}, 50);
						$( "#response" ).val("");
				   	}
				$("#response").css("border-bottom-color","red");
	    			setTimeout(function() {
                   	$("#response").css("border-bottom-color","white");
                }, 500);
	    		}
	    		
	    		shakeanimation = false;
	    		//$("#response").css("border-bottom-color","white");
	    		
			}

	        $(document).keypress(function(e) {
	            if(e.which == 13 && started==true){
	                var response = $("#response").val();
	                if(response == ("mario" || "Mario")){
	                	$("#mario").remove();
	                }
	                $.ajax({
	                    type:'POST',
	                    url: "guess.php",
	                    data:{ 
	                          "guess": response
	                        },
	                    success: function(response){
	                    	
	                    	if(response == "fin"){
	                    		/*fade*/
	                    		$("#clock").fadeOut(600);
	                    		$("#livescon").fadeOut(600);
	                    		$("#response").fadeOut(600);
	                    		$("#title").fadeOut(600);
	                    		$("#othertitlehr").fadeOut(600);
	                    		$("#question").fadeOut(600, function(){
	                    			$("#congrats").fadeIn(600, function(){
	                    				$("#leaderboardusername").fadeIn(600);
	                    				$("#response").remove();
	                    			});
	                    		});
	                    		ended = true;
								
								var timeused = $("#clock").html();
	                    			$.ajax({
					                    type:'POST',
					                    url: "point.php",
					                    data:{ 
					                          "time": timeused
					                        },
					                    success: function(response){
					                    	$("#yourscore").html("Score: " + response);
					                    	$("#mario").remove();
					                    	myfinalscore = response;
					                    }
					                });
	                    	} else if (response.length > 0){
	                        	$('#question').html(response);
	                        	$("#response").css("border-bottom-color","#00FF4C");
					    			setTimeout(function() {
				                   	$("#response").css("border-bottom-color","white");
				                }, 500);
	                        	$("#response").val("");
								restorehearts();
	                    	} else {
	                    		shakeForm();
	                    		removeheart();
	                    	}
	                    }
	                });
	            }
	        });
	        
	        $(document).keypress(function(e) {
	            if(e.which == 13 && started== 0 && ended == false){
				$("#response").focus();
				$("html").css("background-image","none");
				$("html").css("background-color","#487585");
				//$(".html").removeChild(link);
	        	//$("#startgame").fadeOut(600);
	        	$("#instruction-title").fadeIn(600);
	        	$("#instructions").fadeIn(600, function(){
	        		started = 2;
	        	});
	            }
	        });

	        $(document).keypress(function(e) {
	            if(e.which == 13 && started== 2 && ended == false){
				$("#response").focus();
				$("html").css("background-image","none");
				$("html").css("background-color","#487585");
	        	$("#startgame").fadeOut(600);
	        	$("#instruction-title").fadeOut(600);
	        	$("#instructions").fadeOut(600, function(){
	        		$("#response").fadeIn(600);
	        		$("#clock").fadeIn(600);
	        		$("#question").fadeIn(600);
	        		$("#livescon").fadeIn(600);
	        		
	        		started = 1;
	        	});
	            	
	        		tick(0);
	            }
	        });
	        
	        var tick = function(time) {
	        	$("#clock").html(time);
	        	setTimeout(function(){tick(time+1);}, 1000);
	        };
	        
	        
	        $("#startgame").on("click",function(e) {

				$("#response").focus();
				$("html").css("background-image","none");
				$("html").css("background-color","#487585");
				//$(".html").removeChild(link);
	        	//$("#startgame").fadeOut(600);
	        	$("#instruction-title").fadeIn(600);
	        	$("#instructions").fadeIn(600, function(){
	        		started = 2;
	        	});
	        });
	        
	        var visiblehearts = 5;
	        
	        var restorehearts = function(){
	        	$("#heart5").show();
	        	$("#heart4").show();
	        	$("#heart3").show();
	        	$("#heart2").show();
	        	$("#heart1").show();
	        	visiblehearts = 5;
	        };
	        
	        var removeheart = function(){
	        	visiblehearts = visiblehearts - 1;
	        	if(visiblehearts == 4){
	        		$("#heart5").hide();
	        	}
	        	else if(visiblehearts == 3){
	        		$("#heart4").hide();
	        	}
	        	else if(visiblehearts == 2){
	        		$("#heart3").hide();
	        	}
	        	else if(visiblehearts == 1){
	        		$("#heart2").hide();
	        	}
	        	else if(visiblehearts == 0){
	        		var hi = visiblehearts;
	        		visiblehearts = 5;
	        		$.ajax({
	                    type:'POST',
	                    url: "fail.php",
	                    data:{ 
	                          "fail": hi
	                        },
	                    success: function(response){
	                    	
	                    	if(response == "fin"){
	                    		/*fade*/
	                    		$("#clock").fadeOut(600);
	                    		$("#livescon").fadeOut(600);
	                    		$("#response").fadeOut(600);
	                    		$("#title").fadeOut(600);
	                    		$("#othertitlehr").fadeOut(600);
	                    		$("#question").fadeOut(600, function(){
	                    			$("#congrats").fadeIn(600, function(){
	                    				$("#response").remove();
	                    				$("#leaderboardusername").fadeIn(600);
	                    			});
	                    		});
	                    		ended = true;
								var timeused = $("#clock").html();
								
                    			$.ajax({
				                    type:'POST',
				                    url: "point.php",
				                    data:{ 
				                          "time": timeused
				                        },
				                    success: function(response){
				                    	$("#yourscore").html("Score: " + response);
				                    	myfinalscore = response;
				                    }
				                });
	                    	} else if (response.length > 0) {
	                        	$('#question').html(response);
	                        	$("#response").val("");
	                        	restorehearts();
	                    	}
	                    }
	                 });
	        	}
	        };

	        $("#leaderboardusername").keypress(function(e){
	        	if(e.which == 13){
	        	var username = $("#leaderboardusername").val();
				/*send our data into the database*/
	        	$.ajax({
                type:'POST',
                url: "send.php",
                data:{
                      "myfinalscore": myfinalscore,
                      "username": username
                    },
                    success: function(stuff){
                    	//alert(stuff);
                    }
	        	});
	        	
	        	/*retrieve that data from the database*/
	        	var foo="";
	        
	        	function compare(a, b) {
	        		return a.score - b.score;
	        	}
	        
		        $.ajax({
	                type:'POST',
	                url: "retrieve.php",
	                data:{ 
	                     "time": foo
	                },
	                success: function(docinfo) {
					    var data = JSON.parse(docinfo).sort(compare).reverse().slice(0, 10);
					    console.log(data);
	    				var out = "<table class='col-sm-12'>";
	    				for (var i = 0; i < data.length; i++) {
	    					
	    					var ranknum = i+1;
	    					
				        	out += "<tr><td class='ltable'>"+ ranknum +"</td><td class='ltable'>" +
				        	data[i].name +
				        	"</td><td class='ltable'>" +
				        	data[i].score +
				        	"</td><td>"
	    				}
					    out += "</table>";
					    $("#table").html(out);
					    $("table").fadeIn(600);
					    $("#leaderboardheader").fadeIn(600);
					}
			    });
		            
		            /*overlay*/
		        	$(".body").css("background-color","#487585");
		            //$(".body").animate({opacity: "0.4"},500);
		            //fade out the background elements
					$("#leaderboardusername").fadeOut(600);
					$("#yourscore").fadeOut(600);
					$("#congrats").fadeOut(600,function(){
						$(".table").fadeIn(600);
					});
	        	}
	        });
	});
	
	</script>
	
	<body class="body">
    	<div class="container-narrow">
        	<div class="row-fluid">
                <div class="col-sm-12">
                    <h1 id="title">Word Mix</h1>
                </div>
            </div>
            <div class="row-fluid">
                <hr id="othertitlehr">
            </div>
            <div class="row-fluid">
                <div class="col-sm-12">
                	<h2 id="instruction-title">How to Play</h2>
                    <p id="instructions">A phrase will show up on the screen. Your job is to determine related words. Your word can also be an opposite of the word shown<br>
					ex: student taxi - schoolbus<br>
					You get 5 guesses per phrase.
					</p>
                </div>
            </div>
            <div class="row-fluid">
                 <div class="col-sm-12" id="startgame">Press Enter</div>
            </div>
            <br>
            <div class="row-fluid">
                <div class="col-sm-12">
                    <h3 id="question"><?php echo($questions[$_SESSION["question"]]); ?></h3>
                </div>
            </div>
            <div class="row-fluid">
            	<div class="col-sm-12">
                	<input type="text" id="response" autocomplete="off">
              	</div>
          	</div>
          	<div class="row-fluid">
          		<div class="col-sm-4">
          			<!--score displayed here-->
          		</div>
          		<div class="col-sm-4" id="livescon">
          			<!-- Hearts icon by Icons8 -->
					<img id="heart1" src="https://maxcdn.icons8.com/Color/PNG/24/Gaming/hearts-24.png" title="Hearts" width="24">
					<img id="heart2" src="https://maxcdn.icons8.com/Color/PNG/24/Gaming/hearts-24.png" title="Hearts" width="24">
					<img id="heart3" src="https://maxcdn.icons8.com/Color/PNG/24/Gaming/hearts-24.png" title="Hearts" width="24">
					<img id="heart4" src="https://maxcdn.icons8.com/Color/PNG/24/Gaming/hearts-24.png" title="Hearts" width="24">
					<img id="heart5" src="https://maxcdn.icons8.com/Color/PNG/24/Gaming/hearts-24.png" title="Hearts" width="24">
          		</div>
          	</div>
          	<div class="row-fluid">
	          	<div class="col-sm-12" id="clock">
	          	</div>
	        </div>
          	<div class="row-fluid">
          		<h1 id="congrats">Thanks for playing our game!</h1>
          	</div>
          	<div class="row-fluid">
          		<div class="col-sm-12">
          			<div id="leaderboardheader">Leaderboards</div>
          		</div>
          	</div>
          	<div class="row-fluid">
          		<div id="table">
          		</div>
          	</div>
          	<div class="row-fluid">
          		<div class="col-sm-12">
          			<h6 id="yourscore"></h6>
          		</div>
          	</div>
          	<div class="row-fluid">
          		<div class="col-sm-12">
          			<input type="text" id="leaderboardusername" autocomplete="off" placeholder="Enter your name!">
          		</div>
          	</div>
       </div>
	</body>
</html>
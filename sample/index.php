<?php
$LIMIT = 1000;
session_start();
$_SESSION["number"] = rand(0, $LIMIT);
$_SESSION["tries"] = 0;
?>
<html>
<head>
	<title>Guess a number</title>
	<meta charset="UTF-8"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#check").click(function(){
				var number = $("#number").val();
				var url = "guess.php?number=" + number;
				$.get(url, function(data){
					var response = JSON.parse(data);
					if(response.end_game){
						alert("Congratulations. You have guessed a number in " + response.tries + " tries.");
						$("#number").disable();
						$("#check").unbind("click");
					}
					else{
						alert(response.message);
					}
				});
			});
		});
	</script>
</head>
<body>
Guess a number: <input type="text" name="number" id="number" /> <button id="check">Check</button>
</body>
</html>
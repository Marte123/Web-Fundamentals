<?php
	session_start();
	
	if(!isset($_GET["x"])){
		echo "Coordinates is not given.";
	die();}	
	elseif (!isset($_GET["y"])){
		echo "Coordinates is not given.";
	die();}	
	
	
	
	$end_game = false;
	$hit = false;
	
	for($x=0;$x<5;$x++){
		if(isset ($_SESSION["battleship"][$x])){
	if($_GET["x"] == $_SESSION["battleship"][$x]['X'] && $_GET["y"] == $_SESSION["battleship"][$x]['Y']){
		
		unset($_SESSION["battleship"][$x]);
		$hit = true;
		
	}
	
	}
	
	
	}
	
	for($x=0;$x<4;$x++){
		if(isset ($_SESSION["battleshipK"][$x])){
	if($_GET["x"] == $_SESSION["battleshipK"][$x]['X'] && $_GET["y"] == $_SESSION["battleshipK"][$x]['Y']){
		
		unset($_SESSION["battleshipK"][$x]);
		$hit = true;
		
	}
	
	}
	
	
	}
	
	
	for($x=0;$x<3;$x++){
		if(isset ($_SESSION["battleshipB1"][$x])){
	if($_GET["x"] == $_SESSION["battleshipB1"][$x]['X'] && $_GET["y"] == $_SESSION["battleshipB1"][$x]['Y']){
		
		unset($_SESSION["battleshipB1"][$x]);
		$hit = true;
		
	}
	
	}
	
	
	}
	
	for($x=0;$x<3;$x++){
		if(isset ($_SESSION["battleshipB2"][$x])){
	if($_GET["x"] == $_SESSION["battleshipB2"][$x]['X'] && $_GET["y"] == $_SESSION["battleshipB2"][$x]['Y']){
		
		unset($_SESSION["battleshipB2"][$x]);
		$hit = true;
		
	}
	
	}
	
	
	}
	
	for($x=0;$x<2;$x++){
		if(isset ($_SESSION["battleshipS"][$x])){
	if($_GET["x"] == $_SESSION["battleshipS"][$x]['X'] && $_GET["y"] == $_SESSION["battleshipS"][$x]['Y']){
		
		unset($_SESSION["battleshipS"][$x]);
		$hit = true;
		
	}
	
	}
	}
	
	if(empty( $_SESSION["battleship"]) && empty( $_SESSION["battleshipK"])&& empty( $_SESSION["battleshipB1"])&& empty( $_SESSION["battleshipB2"])&& empty( $_SESSION["battleshipS"])){
		$end_game = true;
	}
	
	$tries = $_SESSION["tries"]++;
	$response = array(
		
		"end_game" => $end_game,
		"tries" => $tries,
		"hit" => $hit
	);

	echo json_encode($response);
?>
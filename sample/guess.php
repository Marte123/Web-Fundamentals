<?php
	session_start();
	if(!isset($_GET["number"])){
		echo "Number not given.";
		die();
	}
	
	$message = "";
	$end_game = false;
	if($_GET["number"] < $_SESSION["number"]){
		$message = "Number is too small.";
	}
	else if($_GET["number"] > $_SESSION["number"]){
		$message = "Number is too big.";
	}
	else{
		$end_game = true;
	}
	$tries = $_SESSION["tries"]++;
	
	$response = array(
		"message" => $message,
		"end_game" => $end_game,
		"tries" => $tries
	);
	
	echo json_encode($response);
?>
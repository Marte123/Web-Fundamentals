<?php 
include_once 'databasee.php'; 
session_start();
$error = "";
if(isset($_POST["login"])){
	$username = $_POST["username"];
	$password = $_POST["password"];

	if(strlen($username)>0) {
		$_SESSION["USER"] = $username;
		header("Location: /");
		die();
	}
	else{
		$error = "Invalid login data.";
	}
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>log in</title>
	<meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
<form action="login.php" method="POST">
<div class="continer" style="top:50%; left:50%; position: absolute; transform: translate(-50%, -50%);">
<div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username"><br/>
</div>
<div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div><br/>
  <button type="submit" class="btn btn-primary">Submit</button> <br/>
 </div>
<span><?php echo $error;?></span>
</form>

</body>
</html>
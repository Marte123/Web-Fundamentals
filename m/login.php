<?php 

include_once 'functions.php'; 

$error = "";

makeUnprotected();

if(isset($_POST["login"])){
	$username = isset($_POST["username"]) ? $_POST["username"] : "";
	$password = isset($_POST["password"]) ? $_POST["password"] : "";

	if(validCredentials($username, $password, $users) == true) {
		$_SESSION["USER"] = $username;
		header("Location: /m/indexx.php");
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
    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter username"><br/>
</div>
<div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
  </div><br/>
  <button type="submit" id="login" name="login" class="btn btn-primary">Submit</button> <br/>
 </div>
<span><?php echo $error;?></span>
</form>

</body>
</html>
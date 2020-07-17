<?php 
include_once 'functions.php';

$authError = !checkLoggedIn(true);

refreshSessionTime();

?>

<!DOCTYPE html>
<html>
<head>
    <title>article</title>
	<meta charset="UTF-8"/>
</head>
<body>
<h2>
<?php

$id = isset($_GET["id"]) ? $_GET["id"] : null;
$check = true;

if ($authError == false) {
    foreach($news as $article){
    	if ($article->id == $id) {
    	echo "</br><li>".$article->title."</li>";
    
    	
    	echo "<p>".$article->content."</p>";
    	echo "</br>";
    	echo $check = false;
    }}
    
	if ($check) {
		echo "Warning! "; 
		echo "</br>";
		echo "</br>";
		echo "Write proper id!";
		echo "</br>";
	}    
	echo '<button onclick="window.history.back()">Back</button>';
} else {
    echo '<p>Trying to access protected content. Shhh, no one has to know.</p>';
    echo '<a href = "login.php"><button type="button" class="btn btn-default">Log in</button></a>';
}

?>
</h2>
</body>
</html>
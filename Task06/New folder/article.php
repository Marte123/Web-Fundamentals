<?php 
include_once 'databasee.php'; 
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
		echo "Write propper id!";
		
	}


?>
</h2>
</body>
</html>
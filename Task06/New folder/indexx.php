	<?php 
include_once 'database.php'; 
session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Tasks</title>
    <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body>
<div class="container">
	  <div class="jumbotron">
		<h2>News</h2></br>
		<?php if(!isset($_SESSION["USER"])) {?>
		<a href = "login.php"><button type="button" class="btn btn-default">Log in</button></a>
		<ul>
		<?php } else { ?> 
Hello, <?php echo $_SESSION["USER"];?>! <a href = "logout.php"><button type="button" class="btn btn-default">Log out</button></a>
<?php } ?>
</form>
<?php
foreach($news as $article){
	echo "</br><li>".$article->title."</li>";

	echo "<button><a href = 'article.php?id=".$article->id."'>Go to</a></button>";
	
	echo "</br>";}
?></ul>
	  </div>
</div>
</body>
</html>
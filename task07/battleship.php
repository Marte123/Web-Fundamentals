<?php

session_start();
$_SESSION["battleship"]= array("point1","point2","point3","point4","point5");
$_SESSION["battleshipK"]= array("point1","point2","point3","point4");
$_SESSION["battleshipB1"]= array("point1","point2","point3");
$_SESSION["battleshipB2"]= array("point1","point2","point3");
$_SESSION["battleshipS"]= array("point1","point2");


$board = array(); 
$b = array(); 
$b = array_pad($b,10,"W"); 
$board = array_pad($board,10,$b); 

 // Place the ship onto the board. 
// Typicall call would be placeShip(board, 5, "C") for a five spot carrier ship.
function placeShip(&$board, $shipSize, $shipMarker) {
    $shipPlacement = findPlaceOnBoard($board, $shipSize);
		
     while (!checkForSafePlacement($board, $shipSize, $shipPlacement["start_x"], $shipPlacement["start_y"], $shipPlacement["orientation"])) {
        $shipPlacement = findPlaceOnBoard($board, $shipSize);
    } 
		
    $orientation = $shipPlacement["orientation"];
    $startY = $shipPlacement["start_y"];
    $startX = $shipPlacement["start_x"];
		
    if ($orientation == 0) {
        for ($i = 0; $i < $shipSize; $i++) {
            $board[$startY][$startX + $i] = $shipMarker;
        }
    }
    else {
        for ($i = 0; $i < $shipSize; $i++) {
            $board[$startY + $i][$startX] = $shipMarker;
        }
    }
	
	$counter=0;
	
	for ($i = 0; $i < count($board[0]); $i++){
		for ($j = 0; $j < count($board[0]); $j++){
			if($board[$i][$j]==="C")
			{	
				$_SESSION["battleship"][$counter]=array("X"=>$i,"Y"=>$j);
				$counter++;
			}
		}
	} 
	$counterK=0;
	for ($i = 0; $i < count($board[0]); $i++){
		for ($j = 0; $j < count($board[0]); $j++){
			if($board[$i][$j]==="K")
			{	
				$_SESSION["battleshipK"][$counterK]=array("X"=>$i,"Y"=>$j);
				$counterK++;
			}
		}
	} 
	$counterB1=0;
	for ($i = 0; $i < count($board[0]); $i++){
		for ($j = 0; $j < count($board[0]); $j++){
			if($board[$i][$j]==="B1")
			{	
				$_SESSION["battleshipB1"][$counterB1]=array("X"=>$i,"Y"=>$j);
				$counterB1++;
			}
		}
	} 
	$counterB2=0;
	for ($i = 0; $i < count($board[0]); $i++){
		for ($j = 0; $j < count($board[0]); $j++){
			if($board[$i][$j]==="B2")
			{	
				$_SESSION["battleshipB2"][$counterB2]=array("X"=>$i,"Y"=>$j);
				$counterB2++;
			}
		}
	}
	$counterS=0;
	for ($i = 0; $i < count($board[0]); $i++){
		for ($j = 0; $j < count($board[0]); $j++){
			if($board[$i][$j]==="S")
			{	
				$_SESSION["battleshipS"][$counterS]=array("X"=>$i,"Y"=>$j);
				$counterS++;
			}
		}
	} 
}
	
	
// Look at the board and find a random place to place a ship.
// Return the starting X,Y and orientation for the ship in an array.
function findPlaceOnBoard(&$board, $shipSize) {
    $orientation = rand(0,1);
		
    $maxStartCoord = (count($board[0]) - $shipSize);
		
    if ($orientation == 0) {
        // Horizontal
        $startX = rand(0,$maxStartCoord);
        $startY = rand(0,count($board) - 1);
    }
    else {
        // Vertical
        $startX = rand(0,count($board[0]) - 1);
        $startY = rand(0,$maxStartCoord);
    }
		
    return  array("start_x" => $startX, "start_y" => $startY, "orientation" => $orientation);
}
placeShip($board,5,"C");
placeShip($board,4,"K");
placeShip($board,3,"B1");
placeShip($board,3,"B2");
placeShip($board,2,"S");

	
 // Check to see if it is safe to place the ship at starting X,Y with given orientation
// Here "W" is a marker for open water. Use whatever marker determines open water.
// Returns true if it is safe to place the ship at the specified location with given orientation.
function checkForSafePlacement(&$board, $shipSize, $startX, $startY, $orientation) {
    if ($orientation == 0) {
        for ($i = 0; $i < $shipSize; $i++) {
            if ($board[$startY][$startX + $i] != "W") { return false; }
        }
    }
    else {
        for ($i = 0; $i < $shipSize; $i++) {
            if ($board[$startY + $i][$startX] != "W") { return false; }
        }
    }
    return true;
}
 
$_SESSION["tries"] = 0;



//echo '<hr/><pre>' . print_r($_SESSION, 1) . '</pre><hr/>'
?>

<html>
<head>
	<title>Battleship</title>
	<meta charset="UTF-8"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<style>
	td,tr{
		border-left:2px;
		background-color: grey;
	}
	
	.red-cell {
   background-color: #F00;
}

.blue-cell {
   background-color: blue;
}
	
	</style>
</head>
<body>

<table  cellpadding="15">
<tbody>
<?php for ($x = 0; $x < 10; $x++){
echo "<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>";
}
?>
</tbody>
</table>
<br>
<br>
<button id="newgame"> New game</button>

<script>
$(document).ready(function(){
	$('td').click(function(){
						
				var x = this.cellIndex ;
				var y = this.parentNode.rowIndex ;
				var url = "check.php?x=" + x+"&y="+y;
			var cell = this;
			$(cell).off('click');
		$.get(url, function(data){
					var response = JSON.parse(data);
					
					
	  if(response.hit)
	  {
						$(cell).toggleClass("red-cell");
						alert("Your shoot is good!");
					}
					else
					{
						$(cell).toggleClass("blue-cell");
						alert("You missed:(");
					}
			
					if(response.end_game){
						alert("Congratulations. You won the game in " + response.tries + " tries.");
						$('td').off('click');
						
					}
					
		});
		
		
	});
	
	$("#newgame").click(function(){
				
				 
		$.post("reset.php",

   {data : $(this).html()});
});
					
					
					
					
	  
					
		});
		
		
	
	

</script>


</body>
</html>
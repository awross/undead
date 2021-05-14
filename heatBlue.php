<?php
include("core/coreHead.php");

$eventNum = "44";

$content .= "<img src='images/newMap.jpg' style='position:absolute; top:280; left:0;' />";

$content .= "
	<form action='heatBlue.php' method='get'>
		<select name='id'>
";

$data = mysql_query("SELECT game_op.mid, game_op.status, members.lname, members.fname FROM `game_op` LEFT JOIN `members` ON game_op.mid = members.mid WHERE game_op.eid = '$eventNum' AND game_op.status <> 'H' ORDER BY lname ASC;");
$num = mysql_num_rows($data);

for($i = 0; $i < $num; $i++) {
	$content .= "<option value='" . mysql_result($data, $i, "game_op.mid") . "'";
	
	if($_GET["id"] == mysql_result($data, $i, "game_op.mid")) {
		$content .= " selected";
	}
	
	$content .= ">" . mysql_result($data, $i, "lname") . ", " . mysql_result($data, $i, "fname") . "</option>";
}

$content .= "
		</select>
		<input type='submit' value='Go' />
	</form>
";

$content .= "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />Heat Map is for Spring Game, 2010<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";

if ($_GET["id"] == "") {
	$data = mysql_query("SELECT * FROM `game_op` WHERE eid = '$eventNum' AND status = 'Z' ORDER BY timeofdeath ASC;");
} else {
	$data = mysql_query("SELECT * FROM `game_op` WHERE eid = '$eventNum' AND killed_by = '" . $_GET["id"] . "' ORDER BY 
timeofdeath ASC;");
}
$num = mysql_num_rows($data);

for($i = 0; $i < $num; $i++)
{
	$x = mysql_result($data, $i, "killedX");
	$y = mysql_result($data, $i, "killedY");
	if($x > 25 && $y > 5)
	$content .= "<img src='images/point.jpg' style='position:absolute; top:" . ($y+277) . "; left:" . ($x-3) . ";' />";
}

include("core/coreFoot.php");
?>

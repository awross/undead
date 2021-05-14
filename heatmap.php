<?php
include("core/coreHead.php");

$content .= "<img src='images/newMap.jpg' style='position:absolute; top:230; left:0;' />";

$content .= "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";

if ($_GET["id"] == "") {
	$data = mysql_query("SELECT * FROM `game_op` WHERE eid = '40' AND status <> 'H' ORDER BY timeofdeath ASC;");
} else {
	$data = mysql_query("SELECT * FROM `game_op` WHERE eid = '40' AND killed_by = '" . $_GET["id"] . "' ORDER BY 
timeofdeath ASC;");
}
$num = mysql_num_rows($data);

for($i = 0; $i < $num; $i++)
{
	$x = mysql_result($data, $i, "killedX");
	$y = mysql_result($data, $i, "killedY");
	if(!($x == 0 & $y == 0))
	$content .= "<img src='images/point.jpg' style='position:absolute; top:" . ($y+227) . "; left:" . ($x-3) . ";' />";
}

include("core/coreFoot.php");
?>

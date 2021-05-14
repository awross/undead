<?php
include("core/coreHead.php");

if($_SESSION['admin'] == 'true') {

$query = "SELECT * FROM `events` WHERE end > '" . time() . "' AND type = 'G' ORDER BY start LIMIT 1;";
$result = mysql_query($query);
$sTime = mysql_result($result, 0, 'start');
$eTime = mysql_result($result, 0, 'end');

$query = "SELECT game_op.mid, game_op.status, game_op.timeofdeath, game_op.killed_by, members.fname, members.lname, members.handle, members.rid, members.email, res_hall.clan FROM `game_op` RIGHT JOIN `members` ON game_op.mid = members.mid RIGHT JOIN `res_hall` ON members.rid = res_hall.rid WHERE game_op.eid = '" . mysql_result($result, 0, 'eid') . "' AND game_op.active = '1' ORDER BY game_op.status, res_hall.clan;";
$results=mysql_query($query);
$numRows=mysql_numrows($results);


$content .= "
<div id='post'>
	<div id='title'>
		<h2>" . mysql_result($result, 0, 'title') . "</h2>
		<table>
			<tr><td width='120px'><small>Starts:</td><td>" . date('D, m-d Hi', $sTime) . "</small></td></tr>
			<tr><td><small>Ends:</td><td>" . date('D, m-d Hi', $eTime) . "</small></td></tr>
			<tr><td><small>Location:</td><td>" . mysql_result($result, 0, 'location') . "</small></td></tr>
		</table>
	</div>
</div>
<br /><br />
";
$Human = "
<center><h2>Resistance Email List</h2></center><br />";

$Zombie = "
<center><h2>Undead Email List</h2></center><br />";

$ZombieNE = "<br /><br /><strong><u>Undead No Email List</u></strong><br />";
$HumanNE = "<br /><br /><strong><u>Resistance No Email List</u></strong><br />";

for($i = 0; $i < $numRows; $i++) {
	if (mysql_result($results, $i, "status") != "H") {
		if (mysql_result($results, $i, "email") > "" ) {
			$Zombie .= mysql_result($results, $i, "email") . "; ";
		} else {
			$ZombieNE .= mysql_result($results, $i, "fname") . " " . mysql_result($results, $i, "lname") . "<br />";
		}
	} else {
		if (mysql_result($results, $i, "email") > "" ) {
			$Human .= mysql_result($results, $i, "email") . "; ";
		} else {
			$HumanNE .= mysql_result($results, $i, "fname") . " " . mysql_result($results, $i, "lname") . "<br />";
		}
	}
}

//$Human .= $HumanNE;
//$Zombie .= $ZombieNE;

$content .= $Human . $Zombie;

$ALLNE = "<br /><br /><strong><u>All Players - No Email List</u></strong><br />";;
$content .= "<br /><center><h2>All Players Email List</h2></center><br /><br />";
for($i = 0; $i < $numRows; $i++) {
	if (mysql_result($results, $i, "email") > "" ) {$content .= mysql_result($results, $i, "members.email") . "; ";}
	else {$ALLNE .= mysql_result($results, $i, "fname") . " " . mysql_result($results, $i, "lname") . "<br />";}
}
//$content .= $ALLNE;

}
include("core/coreFoot.php");
?>
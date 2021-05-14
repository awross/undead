<?php
include("core/coreHead.php");

$query = "SELECT * FROM `events` WHERE eid = '" . $_GET['event'] . "';";
$result = mysql_query($query);

$query = "SELECT game_op.status, members.fname, members.lname, members.handle, res_hall.clan FROM `event_roster` JOIN `game_op` on event_roster.mid = game_op.mid JOIN members ON event_roster.mid = members.mid JOIN res_hall ON members.rid = res_hall.rid WHERE event_roster.eid = '" . $_GET['event'] . "' ORDER BY members.lname;";
$results = mysql_query($query);
$numrows = mysql_num_rows($results);

$content .= "
	<div class='title'>
		<h2>Mission Roster</h2>
	</div>
";

$table = "
	<table width='660px' border='0'>
		<thead>
		<tr>
			<th align='left'></th>
			<th align='left'>Name</th>
			<th align='left'>Clan</th>
		</tr>
		</thead>
		<tbody>
";

$Zombie .= "<small><h2>Undead</h2></small>" . $table;
$Human .= "<small><h2>Resistance</h2></small>" . $table;
	
for ($i=0; $i<$numrows; $i++) {
	$toAdd = "
		<tr>
			<td>" . ($i+1) . "</td>
			<td>" . mysql_result($results, $i, 'fname') . " '" . mysql_result($results, $i, 'handle') . "' " . mysql_result($results, $i, 'lname') . "</td>
			<td>" . mysql_result($results, $i, 'clan') . "</td>
		</tr>
	";
	
	if (mysql_result($results, $i, 'status') != "H") {
		$Zombie .= $toAdd;
	} else {
		$Human .= $toAdd;
	}
}
$table = "
	</tbody>
	</table>
";

$Zombie .= $table ;
$Human .= $table;

$content .= $Zombie . "<br /><br />" . $Human;

include("core/coreFoot.php");
?>
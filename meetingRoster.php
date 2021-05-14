<?php
include("core/coreHead.php");

$query = "SELECT * FROM `events` WHERE eid = '" . $_GET['event'] . "';";
$result = mysql_query($query);
$query = "SELECT event_roster.mid, members.fname, members.lname, members.handle FROM `event_roster` LEFT JOIN members ON event_roster.mid = members.mid WHERE event_roster.eid = '" . $_GET['event'] . "' ORDER BY members.lname;";
$results = mysql_query($query);
$numrows = mysql_num_rows($results);

$content .= "
	<div class='title'>
		<h2>Meeting Roster</h2>
	</div>
	<table width='660px' border='1'>
		<thead>
		<tr>
			<th align='left'></th>
			<th align='left'>Name</th>
			<th align='left'>Nickname</th>
		</tr>
		</thead>
		<tbody>
";

for ($i=0; $i<$numrows; $i++) {
	$content .= "
		<tr>
			<td>" . ($i+1) . "</td>
			<td>" . mysql_result($results, $i, 'lname') . ", " . mysql_result($results, $i, 'fname') . "</td>
			<td>" . mysql_result($results, $i, 'handle') . "</td>
		</tr>
	";
}

$content .= "
	</tbody>
	</table>
";
include("core/coreFoot.php");
?>
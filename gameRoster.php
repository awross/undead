<?php
include("core/coreHead.php");

$query = "SELECT * FROM `events` WHERE eid = '" . $_GET['event'] . "';";
$result = mysql_query($query);

$query = "SELECT members.fname, members.lname, members.handle, res_hall.clan FROM `event_roster` LEFT JOIN members ON event_roster.mid = members.mid LEFT JOIN res_hall ON members.rid = res_hall.rid WHERE event_roster.eid = '" . $_GET['event'] . "' ORDER BY res_hall.clan ASC, members.lname ASC;";
$results = mysql_query($query);
$numrows = mysql_num_rows($results);

$numHelp = 0;
$group = "";
$tGroup = "";
$first = true;

$content .= "<span class='title'><h1>Game Roster</h1></snap> <br /><br /><br />";
	
for ($i=0; $i<$numrows; $i++) {
	$group = mysql_result($results, $i, 'clan');
	
	if ($tGroup != $group)
	{
		if (!$first)
		{
			$content .= "
				</tbody>
				</table>
				<br /><br /><br />
			";
		}
		
		$content .= "
			<span class='title'><h2>$group</h2></snap>
			<table width='660px' border='0'>
				<tbody>
		";
		
		$numHelp = $i;
		
		$first = false;
	}
	
	
	$content .= "
		<tr>
			<td>" . (($i+1)-$numHelp) . "</td>
			<td>" . mysql_result($results, $i, 'fname') . " '" . mysql_result($results, $i, 'handle') . "' " . mysql_result($results, $i, 'lname') . "</td>
		</tr>
	";
	
	$tGroup = mysql_result($results, $i, 'clan');
}

$content .= "
	</tbody>
	</table>
";

include("core/coreFoot.php");
?>
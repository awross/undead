<?php
include("core/coreHead.php");
if($_SESSION['admin'] == 'true') {
	$query = "SELECT * FROM `event_roster` WHERE eid = '" . $_GET['event'] . "' ORDER BY lname;";
	$results = mysql_query($query);
	$numrows = mysql_num_rows($results);
	
	$content .= "
		<table width='660px' border='1'>
			<thead>
			<tr>
				<th align='left'></th>
				<th align='left'>Name</th>
				<th align='left'>Clan</th>
				<th align='left'>Email</th>
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
				<td>" . mysql_result($results, $i, 'email') . "</td>
				<td align='center'><a href='makeAdmin.php?mid=" . mysql_result($results, $i, 'mid') . "'>
			";
		if (mysql_result($results, $i, 'admin') > 0) {
			$content .= "N";
		} else {
			$content .= "A";
		}
		$content .= "
				</a></td>
				<td align='center'><a href='adminEdit.php?action=edit&mid=" . mysql_result($results, $i, 'mid') . "'>E</a></td>
			</tr>
		";
	}
	
	$content .= "
		</tbody>
	</table>
	";
}
include("core/coreFoot.php");
?>
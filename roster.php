<?php
include("core/coreHead.php");
if($_SESSION['admin'] == 'true') {
	$query = "SELECT * FROM `members` ORDER BY lname;";
	$results = mysql_query($query);
	$numrows = mysql_num_rows($results);
	
	$query = "SELECT * FROM `events` WHERE end > '" . time() . "' AND type = 'G' ORDER BY start LIMIT 1;";
	$curgames=mysql_query($query);
	$numCurgames = mysql_numrows($curgames);
	$curgame = false;
	if ($numCurgames > 0) {
		if($numCurgames > 0 && mysql_result($curgames, 0, 'start') < time()) {
			$curgame = true;
		}
	}
	
	$showAddLink = false;
	
	$content .= "
		<table width='660px' border='0'>
			<thead>
			<tr>
				<th align='left'></th>
				<th align='left'>Name</th>
				<th align='left'>Nickname</th>
				<th align='left'>Email</th>
				<th>Toggle Admin</th>
				<th>Edit</th>
	";
	if ($curgame) {
		$content .= "<th>Add</th>";
	}
	$content .= "
			</tr>
			</thead>
			<tbody>
	";
	
	for ($i=0; $i<$numrows; $i++) {
		if ($curgame) {
			$query = "SELECT * FROM `game_op` WHERE mid = '" . mysql_result($results, $i, 'mid') . "' AND eid = '" . mysql_result($curgames, 0, 'eid') . "' AND active;";
			$isInGame=mysql_query($query);
			$test = mysql_numrows($isInGame);
			if ($test > 0) {
				$showAddLink = false;
			} else {
				$showAddLink = true;
			}
		} else  {
			$showAddLink = false;
		}
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
		";
		if ($curgame) {
			if($showAddLink) {
				$content .= "<td><a href='adminReg.php?mid=" . mysql_result($results, $i, 'mid') . "&eid=" . mysql_result($curgames, 0, 'eid') . "'>J</a></td>";
			} else {
				$content .= "<td>-</td>";
			}
		}
		$content .= "
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
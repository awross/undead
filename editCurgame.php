<?php
include("core/coreHead.php");

if($_SESSION['admin'] == 'true') {

$query = "SELECT * FROM `events` WHERE end > '" . time() . "' AND type = 'G' ORDER BY start LIMIT 1;";
$result = mysql_query($query);
$sTime = mysql_result($result, 0, 'start');
$eTime = mysql_result($result, 0, 'end');

$query = "SELECT game_op.mid, game_op.status, game_op.timeofdeath, game_op.killed_by, game_op.killcode, members.fname, members.lname, members.handle, members.rid, res_hall.clan FROM `game_op` RIGHT JOIN `members` ON game_op.mid = members.mid RIGHT JOIN `res_hall` ON members.rid = res_hall.rid WHERE game_op.eid = '" . mysql_result($result, 0, 'eid') . "' AND game_op.active = '1' ORDER BY game_op.status, res_hall.clan;";
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
<center><h2>Resistance</h2></center>
<table width='660px'>
	<thead>
	<tr>
		<th width='2%'> </th>
		<th align='left' width='25%'>Handle</th>
		<th align='left' width='25%'>Name</th>
		<th align='left' width='10%'>Code</th>
		<th align='left' width='10%'>Make Z</th>
		<th align='left' width='10%'>Remove</th>
	</tr>
	</thead>
	<tbody>
";
$Zombie = "
<center><h2>Undead</h2></center>
<table width='760px'>
	<thead>
	<tr>
		<th width='2%'> </th>
		<th align='left' width='25%'>Handle</th>
		<th align='left' width='25%'>Name</th>
		<th align='left' width='10%'>Make H</th>
		<th align='left' width='10%'>Feed</th>
		<th align='left' width='10%'>Remove</th>
	</tr>
	</thead>
	<tbody>
";

$numH = 0;
$numZ = 0;

for($i = 0; $i < $numRows; $i++) {
	if (mysql_result($results, $i, "status") != "H") {
		$handle = mysql_result($results, $i, "mid") == $_SESSION["mid"] ? "<strong><u>" . mysql_result($results, $i, "handle") . "</u></strong>" : mysql_result($results, $i, "handle");
		
		$numZ++;
		$Zombie .= "
			<tr>
				<td>" . $numZ . "</td>
				<td>" . $handle . "</td>
				<td>" . mysql_result($results, $i, "lname") . ", " . mysql_result($results, $i, "fname") . "</td>
				<td><a href='makeH.php?mid=" . mysql_result($results, $i, "mid") . "&eid=" . mysql_result($result, 0, 'eid') . "'>H</a></td>
				<td><a href='feedZ.php?mid=" . mysql_result($results, $i, "mid") . "&eid=" . mysql_result($result, 0, 'eid') . "'>F</a></td>
				<td><a href='KILL.php?mid=" . mysql_result($results, $i, "mid") . "&eid=" . mysql_result($result, 0, 'eid') . "'>K</a></td>
		";
	} else {
		$handle = mysql_result($results, $i, "mid") == $_SESSION["mid"] ? "<strong><u>" . mysql_result($results, $i, "handle") . "</u></strong>" : mysql_result($results, $i, "handle");
		
		$numH++;
		$Human .= "
			<tr>
				<td>" . $numH . "</td>
				<td>" . $handle . "</td>
				<td>" . mysql_result($results, $i, "lname") . ", " . mysql_result($results, $i, "fname") . "</td>
				<td>" . mysql_result($results, $i, "killcode") . "</td>
				<td><a href='makeZ.php?mid=" . mysql_result($results, $i, "mid") . "&eid=" . mysql_result($result, 0, 'eid') . "'>Z</a></td>
				<td><a href='KILL.php?mid=" . mysql_result($results, $i, "mid") . "&eid=" . mysql_result($result, 0, 'eid') . "'>R</a></td>
			</tr>
		";
	}
}

$Human .= "</tbody></table>";
$Zombie .= "</tbody></table>";

$query = "SELECT game_op.mid, game_op.status, game_op.timeofdeath, game_op.killed_by, members.fname, members.lname, members.handle, members.rid, res_hall.clan FROM `game_op` RIGHT JOIN `members` ON game_op.mid = members.mid RIGHT JOIN `res_hall` ON members.rid = res_hall.rid WHERE game_op.eid = '" . mysql_result($result, 0, 'eid') . "' AND game_op.active = '0' ORDER BY members.lname;";
$results=mysql_query($query);
$numRows=mysql_numrows($results);

$Inactive = "
<center><h2>Inactive</h2></center>
<table width='760px'>
	<thead>
	<tr>
		<th width='2%'> </th>
		<th align='left' width='25%'>Handle</th>
		<th align='left' width='25%'>Name</th>
		<th align='left' width='10%'>Make Z</th>
		<th align='left' width='10%'>Make H</th>
	</tr>
	</thead>
	<tbody>
";

for($i = 0; $i < $numRows; $i++) {
	$handle = mysql_result($results, $i, "mid") == $_SESSION["mid"] ? "<strong><u>" . mysql_result($results, $i, "handle") . "</u></strong>" : mysql_result($results, $i, "handle");
	
	$Inactive .= "
		<tr>
			<td>" . ($i+1) . "</td>
			<td>" . $handle . "</td>
			<td>" . mysql_result($results, $i, "lname") . ", " . mysql_result($results, $i, "fname") . "</td>
			<td><a href='feedZ.php?mid=" . mysql_result($results, $i, "mid") . "&eid=" . mysql_result($result, 0, 'eid') . "'>Z</a></td>
			<td><a href='makeH.php?mid=" . mysql_result($results, $i, "mid") . "&eid=" . mysql_result($result, 0, 'eid') . "'>H</a></td>
		</tr>
	";
}

$Inactive .= "</tbody></table>";

$content .= $Human . $Zombie . $Inactive;

}
include("core/coreFoot.php");
?>
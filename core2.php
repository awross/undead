<?php
include("core/coreHead.php");

$query = "SELECT mid FROM `event_roster` WHERE eid = 20;";

$results = mysql_query($query);
$num = mysql_num_rows($results);

$event = array();
$game = array();

for($i=0; $i <$num; $i++) {
	array_push($event, mysql_result($results, $i, 'mid'));
}

$query = "SELECT mid FROM `game_op` WHERE eid = 20;";

$results = mysql_query($query);
$num = mysql_num_rows($results);

for($i=0; $i <$num; $i++) {
	if (!in_array(mysql_result($results, $i, 'mid'), $event)) {
		$content .= mysql_result($results, $i, 'mid') . " NOT IN EVENT ROSTER!<br />";
	}
}

include("core/coreFoot.php");
?>
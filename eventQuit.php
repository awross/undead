<?php
include("core/coreHead.php");
if($_SESSION["loggedin"] == "true")
{
	$this_eid = mysql_real_escape_string($_GET["event"]);
	
	$query = "SELECT * FROM `events` WHERE eid = '" . $this_eid . "';";
	$results=mysql_query($query);
	if(mysql_numrows($results) > 0)
	{
		$query = "SELECT * FROM `event_roster` WHERE eid = '" . $this_eid . "' AND mid = '" . $_SESSION["mid"] . "' LIMIT 1;";
		$participation=mysql_query($query);
		if(mysql_numrows($participation) > 0)
		{
			mysql_query("DELETE FROM `event_roster` WHERE mid = '" . $_SESSION['mid'] . "';");
			mysql_query("DELETE FROM `game_op` WHERE mid = '" . $_SESSION['mid'] . "' AND eid = '" . $this_eid . "';");
			$content .= "Sorry to see you're not able to make it.";
			$head .= "<meta http-equiv='refresh' content='5; URL=events.php'>";
		} else {
			$content .= "You not registered for this event!";
		}
	} else {
		$content .= "No such event";
	}
	
} else {
	$content .= "You must be logged in to quit event";
}

include("core/coreFoot.php");
?>
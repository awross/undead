<?php
include("core/coreHead.php");
if($_SESSION["loggedin"] == "true")
{
	$this_eid = mysql_real_escape_string($_GET["event"]);
	
	$query = "SELECT * FROM `events` WHERE eid = '" . $this_eid . "';";
	$results=mysql_query($query);
	if(mysql_numrows($results) > 0)
	{
		$query = "SELECT * FROM `event_roster` WHERE eid = '" . $this_eid . "' AND mid = '" . $_SESSION["mid"] . "';";
		$participation=mysql_query($query);
		if(mysql_numrows($participation) < 1)
		{
			mysql_query("INSERT INTO `event_roster` (eid, mid) VALUES (" . $this_eid . ", " . $_SESSION["mid"] . ");");
			$content .= "You have sucessfully registered!";
			$head .= "<meta http-equiv='refresh' content='5; URL=events.php'>";
		} else {
			$content .= "You have already registered!";
		}
	} else {
		$content .= "No such event";
	}
	
} else {
	$content .= "You must be logged in to join event";
}

include("core/coreFoot.php");
?>
<?php
include("core/coreHead.php");

$missionViewTime = (8*60*60);

$query = "SELECT * FROM `events` WHERE end > '" . (time() - (60*60*24*.5)) . "' ORDER BY start ASC;";
$results=mysql_query($query);
$numRows=mysql_numrows($results);

for($i=0; $i<$numRows; $i++)
{
	$content .= "<div class='post'>";
	$content .= "<div class='title'><h2>";
	if(mysql_result($results, $i, "type") == "G")
	{
		$content .= "GAME: ";
	} elseif(mysql_result($results, $i, "type") == "M") {
		$content .= "MISSION: ";
	} else {
		$content .= "MEETING: ";
	}
	$content .= mysql_result($results, $i, "title") . "</h2>";
	
	$sTime = mysql_result($results, $i, 'start');
	$eTime = mysql_result($results, $i, 'end');
	$rTime = mysql_result($results, $i, 'end_reg');
	
	if ($_SESSION['admin'] == 'true') {
		$content .= "<small><a href='addEvent.php?action=edit&event=" . mysql_result($results, $i, "eid") . "'>EDIT</a> - <a href='delEvent.php?event=" . mysql_result($results, $i, "eid") . "'>DELETE</a></small>";
	}
	
	$content .= "<p><small>Starts: " . date('D, m-d g:i A', $sTime) . "<br />Ends: " . date('D, m-d g:i A', $eTime) . "</small></p>";
	$content .= "<p><small>Location: " . mysql_result($results, $i, 'location') . "<br /></small></p>";
	if(mysql_result($results, $i, "type") == "G") {
		$content .= "<p><small>Registration Deadline: " . date('D, m-d g:i A', $rTime) . "<br /></small></p>";
	}
	$content .= "<p><small><u><a href='";
	if(mysql_result($results, $i, "type") == "G") {
		$content .= "gameRoster.php?event=";
	} elseif(mysql_result($results, $i, "type") == "M") {
		if((time()+$missionViewTime) >= mysql_result($results, $i, "start")) {
			$content .= "missionRoster.php?event=";
		} else {
			$content .= "#";
		}
	} else {
		$content .= "meetingRoster.php?event=";
	}
	$content .= mysql_result($results, $i, "eid") . "'>" . mysql_num_rows(mysql_query("SELECT * FROM `event_roster` WHERE eid = '" . mysql_result($results, $i, "eid") . "';")) . " current participants.";
	if(mysql_result($results, $i, "type") == "G") {
		$content .= " (" . mysql_num_rows(mysql_query("SELECT * FROM `game_op` WHERE eid = '" . mysql_result($results, $i, "eid") . "' AND active = '1';")) . " active.)";
	}
	$content .= "</a><br /></u></small></p></div><div class='entry'>" . mysql_result($results, $i, "desc") . "</div>";
	if($_SESSION["loggedin"] == "true")
	{
		if (mysql_result($results, $i, "type") == "G" && mysql_result($results, $i, "started") == 0 && $_SESSION['admin'] == 'true') {
			$content .= "<br /><a href='startGame.php?event=" . mysql_result($results, $i, "eid") . "'>Start Game</a>";
		}
		
		$participants = mysql_num_rows(mysql_query("SELECT * FROM `event_roster` WHERE eid = '" . mysql_result($results, $i, "eid") . "';"));
		$query = "SELECT * FROM `event_roster` WHERE eid = '" . mysql_result($results, $i, "eid") . "' AND mid = '" . $_SESSION["mid"] . "';";
		$participation=mysql_query($query);
		
		if(mysql_result($results, $i, "started") == 0) // Not yet started
		{
			if (mysql_numrows($participation) < 1) {
				$content .= "<br />";
				if(mysql_result($results, $i, "type") == "G") {
					$content .= "<form action='lateReg.php' method='get'><input type='hidden' name='event' value='" . mysql_result($results, $i, "eid") . "' /><input type='submit' value='Register for this game!' /></form>";
				} elseif(mysql_result($results, $i, "type") == "M") {
					$content .= "<a href='eventJoin.php?event=" . mysql_result($results, $i, "eid") . "'>Sign up for this mission!";
				} else {
					$content .= "<a href='eventJoin.php?event=" . mysql_result($results, $i, "eid") . "'>RSVP for this meeting!";
				}
				$content .= "</a>";
			} else {
				$content .= "<p><h2><small>You are registered for this event, see you on " . date("D, M jS", mysql_result($results, $i, "start")) . "!<br /><small><small><u><a href='eventQuit.php?event=" . mysql_result($results, $i, "eid") . "'>Quit Event</a></u></small></small></small></h2></p>";
			}
		} else { // Already started
			if (mysql_numrows($participation) < 1) { // Not registered
				if(mysql_result($results, $i, "type") == "G" && mysql_result($results, $i, "started") == '1' && mysql_result($results, $i, "end_reg") > time()) {
					$content .= "<p><h2><small><a href='lateReg.php?event=" . mysql_result($results, $i, "eid") . "'>Register for this game!</a></small></h2></p>";
				} elseif (mysql_result($results, $i, "type") == "G" && mysql_result($results, $i, "end_reg") < time()) {
					$content .= "<p><h2><small>Registration has ended for this event, but you may check the game status <u><a href='curgame.php'>here</a></u>.</small></h2></p>";
				}
			} else { // Registered
				if (mysql_result($results, $i, "type") == "G") {
					$content .= "<br /><a href='curgame.php'>Game Status</a>";
				}
			}
		}
	}
	$content .= "";
	$content .= "</div>";
}

include("core/coreFoot.php");
?>
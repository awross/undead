<?php
include("core/coreHead.php");
if ($_SESSION['admin'] == 'true') {
	srand((double)microtime()*1000000);
	
	$eid = mysql_real_escape_string($_GET["event"]);
	$query = "SELECT * FROM `events` WHERE `eid` = '" . $eid . "' LIMIT 1;";
	$result=mysql_query($query);
	
	if($_GET["action"] == "" && $_GET["event"] != "" && mysql_result($result, 0, "started") == 0) {
		if(mysql_result($result, 0, "started") == '0') {
			$query = "SELECT event_roster.eid, event_roster.mid, members.fname, members.lname, members.handle, members.rid, members.prefer_oz FROM `event_roster` RIGHT JOIN `members` ON event_roster.mid = members.mid WHERE event_roster.eid = '" . $eid . "' ORDER BY lname ASC;";
			$results=mysql_query($query);
			$numRows=mysql_numrows($results);
			$content .= "	
				<div class='title'>
					<h2>Select Original Zombies</h2>
					<small>
						<p>The rules recommend 1 zombie per 100 players.</p>
						<p>That would be " . (1+floor($numRows/100)) . " OZ('s) for this game.</p>
					</small>
				</div>
				<form action='startGame.php?action=start&event=" . $eid . "' method='post'>
				<table width='400px'>";
			
			for($i=0; $i<$numRows; $i++)
			{
				if(mysql_result($results, $i, "prefer_oz") > 0)
				{
					$content .= "<tr><td><input type='checkbox' name='" . mysql_result($results, $i, "mid") . "' /></td><td>" . mysql_result($results, $i, "members.fname") . " '" . mysql_result($results, $i, "members.handle") . "' " . mysql_result($results, $i, "members.lname") . "</td></tr>";
				}
			}
			
			$content .= "
				<tr><td colspan='2'><input type='submit' value='Start the Game!' /></td></tr>
				</table>
				</form>
			";
		} else {
			$content .= "This game has already been started.";
			$head .= "<meta http-equiv='refresh' content='5; URL=events.php'>";
		}
	} elseif ($_GET["action"] == "start" && $_GET["event"] != "" && mysql_result($result, 0, "started") == 0){

		$query = "SELECT event_roster.eid, event_roster.mid, members.fname, members.lname, members.handle, members.rid, members.prefer_oz FROM `event_roster` RIGHT JOIN `members` ON event_roster.mid = members.mid WHERE event_roster.eid = '" . $eid . "';";
		$results=mysql_query($query);
		$numRows=mysql_numrows($results);
/*		
		$len = 8;
		$base='ABCDEFGHKLMNOPQRSTWXYZ345789';
		$max=strlen($base)-1;
		
		for($i=0; $i<$numRows; $i++)
		{
			if(mysql_result($results, $i, "members.prefer_oz") > 0 && $_POST[mysql_result($results, $i, "event_roster.mid")] == "on")
			{
				mysql_query("INSERT INTO `game_op` (eid, mid, status, timeofdeath) VALUES ('" . $eid . "', '" . mysql_result($results, $i, "event_roster.mid") . "', 'OZ', '" . time() . "');");
			} else {
				$killcode='';
				mt_srand((double)microtime()*1000000);
				while (strlen($killcode)<$len) {
					$killcode.=$base{mt_rand(0,$max)};
				}
				
				mysql_query("INSERT INTO `game_op` (eid, mid, status, killcode) VALUES ('" . $eid . "', '" . mysql_result($results, $i, "event_roster.mid") . "', 'H', '" . $killcode . "');");
				$killcode = substr($killcode, 3, 4);
			}
		}
*/
		for($i=0; $i<$numRows; $i++)
		{
			if(mysql_result($results, $i, "members.prefer_oz") > 0 && $_POST[mysql_result($results, $i, "event_roster.mid")] == "on")
			{
				mysql_query("UPDATE `game_op` SET status = 'OZ', timeofdeath = '" . time() . "', killcode = '', killedX = '', killedY = '' WHERE mid = '" . mysql_result($results, $i, "event_roster.mid") . "' AND eid = '" . $eid . "';");
			}
		}
		
		mysql_query("UPDATE `events` SET started='1' WHERE eid = '" . $eid . "';");
		header('Location: curgame.php');
		
	} elseif (mysql_result($result, 0, "started") > 0) {
		$content .= "Game already started.";
		$head .= "<meta http-equiv='refresh' content='5; URL=events.php'>";
	} else {
		$content .= "Game does not exist.";
		$head .= "<meta http-equiv='refresh' content='5; URL=events.php'>";
	}
}
include("core/coreFoot.php");
?>
<?php
include("core/coreHead.php");
//include_once('core/twitter.php');

$code = mysql_real_escape_string(strtoupper($_POST["code"]));

$queryK = "SELECT * FROM `game_op` WHERE game_op.status = 'H' AND eid = '" . $_GET["event"] . "' AND killcode = '" . $code . "';";
$queryF = "SELECT * FROM `zombie_food` WHERE eid = '" . $_GET["event"] . "' AND foodcode = '" . $code . "';";
$queryFU = "SELECT * FROM `zombie_food` WHERE eid = '" . $_GET["event"] . "' AND foodcode = '" . $code . "' AND eaten_by IS NULL;";

$toBeKilled = mysql_query($queryK);
$numKilled = mysql_numrows($toBeKilled);
$toBeEatenU = mysql_query($queryFU);
$numEatenU = mysql_numrows($toBeEatenU);
$toBeEaten = mysql_query($queryF);
$numEaten = mysql_numrows($toBeEaten);


if ($numEaten > $numEatenU) {
	$content .= "This food code has already been used.";
} elseif ($numKilled == 0 && $numEatenU == 0 && $numEaten == 0) {
	$content .= "Code not found.";
	$head .= "<meta http-equiv='refresh' content='5; URL=curgame.php'>";
} elseif ($numEatenU > 0) {
	$query = "UPDATE `zombie_food` SET time_eaten='" . time() ."', eaten_by = '" . $_SESSION['mid'] . "' WHERE eid = '" . $_GET["event"] . "' AND foodcode = '" . $code . "';";
	$result = mysql_query($query);
	$content .= "Food successfully recorded.";
} elseif ($numKilled > 0) {
	$query = "UPDATE `game_op` SET game_op.status='Z', timeofdeath = '" . time() . "', killed_by = '" . $_SESSION["mid"] . "', killedX = '" . $_POST['x'] . "', killedY = '" . $_POST['y'] . "' WHERE eid = '" . $_GET["event"] . "' AND killcode = '" . $code . "' LIMIT 1;";
	$result = mysql_query($query);
	
	$tagger = mysql_result($results, 0, 'fname') . " " . mysql_result($results, 0, 'lname');
	
	$twitQ = "SELECT * FROM `game_op` JOIN `members` ON game_op.mid = members.mid AND game_op.killcode = '$code' AND game_op.eid = '" . $_GET['event'] . "' LIMIT 1;";
	$twit_result = mysql_query($twitQ);
	//$content .= "<br />" . $twitQ;
	
	if (mysql_numrows($twit_result) > 0)
	{
		$twitter_api_url = "http://twitter.com/statuses/update.xml";	
		$twitter_data = "status=";
		$twitter_data .= mysql_result($twit_result, 0, 'fname') . " " . mysql_result($twit_result, 0, 'lname') . " is now a Zombie!";
		$twitter_data .= " #bgundead #HvZ";
		
		$twitter_data = substr($twitter_data, 0, 140);
		
		//$content .= $twitter_data;
		
		$twitter_user = "bgundead";
		$twitter_password = "boxcar187";
		$ch = curl_init($twitter_api_url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $twitter_data);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERPWD, "{$twitter_user}:{$twitter_password}");
		$twitter_data = curl_exec($ch);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if ($httpcode != 200) {
			$content .= "<strong>Error - But its All Good</strong> Something went wrong, and the tweet wasn't posted correctly.";
		}
	}
	
	$content .= "
		<div class='title'>
			<h2>Feed Your Friends!</h2>
		</div>
	";
	
	$content .= "
		<form action='playerFeed.php?eid=" . $_GET["event"] . "' method='post'>
		<table width='660px'>
	";
	
	$query = "SELECT game_op.status, game_op.eid, game_op.mid, members.fname, members.lname FROM `game_op` JOIN `members` ON game_op.mid = members.mid WHERE game_op.status <> 'H' AND game_op.eid = '" . $_GET["event"] . "' ORDER BY members.lname ASC;";
	$results = mysql_query($query);
	$rows = mysql_numrows($results);
	//$content .=  $rows . "<br />";
	for ($i=0; $i < $rows; $i++) {
		$content .= "
			<tr>
				<td><input type='radio' name='zombie1' value='" . mysql_result($results, $i, 'mid') . "' /></td>
				<td><input type='radio' name='zombie2' value='" . mysql_result($results, $i, 'mid') . "' /></td>
				<td>" . mysql_result($results, $i, 'fname') . " " . mysql_result($results, $i, 'lname') . "</td>
			</tr>
		";
		$n++;
	}
	$content .= "
	<tr><td colspan='3' align='center'><input type='submit' value='Feed Them!' /></td></tr>	
	</table>
		</form>
	"; 
	
	$content .= "<br /><a href='curgame.php'>Back to the Game</a>";
}

include("core/coreFoot.php");
?>
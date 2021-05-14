<?php
include("core/coreHead.php");

if ($_SESSION['admin'] == 'true') {

	$today = getdate(time());
	
	$title = mysql_real_escape_string($_POST["title"]);
	$location = mysql_real_escape_string($_POST["location"]);
	$desc = mysql_real_escape_string($_POST["desc"]);
	$type = $_POST["type"];
	
	
	$Months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	
	$sent_sTime = mktime((int)$_POST["sHour"], (int)$_POST["sMin"], 0, (int)$_POST["sMonth"], (int)$_POST["sDay"], (int)$_POST["sYear"]);
	$sent_eTime = mktime((int)$_POST["eHour"], (int)$_POST["eMin"], 0, (int)$_POST["eMonth"], (int)$_POST["eDay"], (int)$_POST["eYear"]);
	$endreg = mktime((int)$_POST["rHour"], (int)$_POST["rMin"], 0, (int)$_POST["rMonth"], (int)$_POST["rDay"], (int)$_POST["rYear"]);
	
	if($sent_sTime > $sent_eTime)
	{
		$temp = $sent_sTime;
		$sent_sTime = $sent_eTime;
		$sent_eTime = $temp;
	}
	
if($_GET["action"] == "edit") {
	$result = mysql_query("SELECT * FROM `events` WHERE eid = '" . $_GET['event'] . "' LIMIT 1;");
	$start = getdate(mysql_result($result, 0, 'start'));
	$end = getdate(mysql_result($result, 0, 'end'));
	$end_reg = getdate(mysql_result($result, 0, 'end_reg'));
	
	
	$content .= "
	<h2>Edit Event</h2><br />
	
	<form name='eventEdit' action='addEvent.php?action=editsubmit&event=" . $_GET['event'] . "' method='post'>
	<table>
		<tr>
			<td>Title:</td>
			<td><input type='text' name='title' size='20' value='" . mysql_result($result, 0, 'title') . "'/></td>
		</tr>
		<tr>
			<td>Location:</td>
			<td><input type='text' name='location' size='20' value='" . mysql_result($result, 0, 'location') . "'/></td>
		</tr>
		<tr>
			<td>Start:</td>
			<td><select name='sMonth'>
	";
			for($i = 0; $i < 12; $i++)
			{
				$content .= "<option value='" . ((int)$i+1) . "'";
				if ($start['mon'] == $i+1)
				{
					$content .= " selected";
				}
				$content .= ">" . $Months[$i] . "</option>";
			}
	$content .="</select><select name='sDay'>";
				for($i = 1; $i < 32; $i++)
				{
					$content .= "<option value='" . ($i) . "'";
					if ($start['mday'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select><select name='sYear'>";
				for($i = (int)$today['year']; $i < (int)$today['year']+2; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($start['year'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select></td></tr><tr><td> </td><td><select name='sHour'>";
				for($i = 0; $i < 24; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($start['hours'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select>:<select name='sMin'>";
				for($i = 0; $i < 60; $i=$i+15)
				{
					$content .= "<option value='" . $i . "'>" . $i . "</option>";
				}
	$content .="</select></td>
			</tr>
			<tr><td> </td><td> </td></tr>
			<tr>
				<td>End:</td>
				<td><select name='eMonth'>";
				for($i = 0; $i < 12; $i++)
				{
					$content .= "<option value='" . ((int)$i+1) . "'";
					if ($end['mon'] == $i+1)
					{
						$content .= " selected";
					}
					$content .= ">" . $Months[$i] . "</option>";
				}
	$content .="</select><select name='eDay'>";
				for($i = 1; $i < 32; $i++)
				{
					$content .= "<option value='" . ($i) . "'";
					if ($end['mday'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select><select name='eYear'>";
				for($i = (int)$today['year']; $i < (int)$today['year']+2; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($end['year'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select></td></tr><tr><td> </td><td><select name='eHour'>";
				for($i = 0; $i < 24; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($end['hours'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select>:<select name='eMin'>";
				for($i = 0; $i < 60; $i=$i+15)
				{
					$content .= "<option value='" . $i . "'>" . $i . "</option>";
				}
	$content .="</select></td>
			</tr>
			<tr><td> </td><td> </td></tr>
			<tr>
				<td>End of Registration:</td>
				<td><select name='rMonth'>";
				for($i = 0; $i < 12; $i++)
				{
					$content .= "<option value='" . ((int)$i+1) . "'";
					if ($end_reg['mon'] == $i+1)
					{
						$content .= " selected";
					}
					$content .= ">" . $Months[$i] . "</option>";
				}
	$content .="</select><select name='rDay'>";
				for($i = 1; $i < 32; $i++)
				{
					$content .= "<option value='" . ($i) . "'";
					if ($end_reg['mday'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select><select name='rYear'>";
				for($i = (int)$today['year']; $i < (int)$today['year']+2; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($end_reg['year'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select></td></tr><tr><td>(Only used in games.)</td><td><select name='rHour'>";
				for($i = 0; $i < 24; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($end_reg['hours'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select>:<select name='rMin'>";
				for($i = 0; $i < 60; $i=$i+15)
				{
					$content .= "<option value='" . $i . "'>" . $i . "</option>";
				}
	$content .="</select></td>
			</tr>
			<tr><td> </td><td> </td></tr>
			<tr>
				<td>Event Type</td>
				<td>
					<select name='type'>
						<option value='E'";
						if (mysql_result($result, 0, 'type') == 'E') {
							$content .= " selected";
						}
						$content .= ">Meeting</option>
						<option value='M'";
						if (mysql_result($result, 0, 'type') == 'M') {
							$content .= " selected";
						}
						$content .= ">Mission</option>
						<option value='G'";
						if (mysql_result($result, 0, 'type') == 'G') {
							$content .= " selected";
						}
						$content .= ">Game</option>
					</select>
				</td>
			</tr>
			<tr><td> </td><td> </td></tr>
			<tr><td colspan='2'><textarea rows='4' cols='80' name='desc'>" . mysql_result($result, 0, 'desc') . "</textarea></td></tr>
			<tr><td colspan='2'><input type='Submit' value='Edit Event' />
		</table>
		</form>
		";
} elseif ($_GET["action"] == "editsubmit") {
	$content .= "<h2>Member Updated</h2><br />";
	
	$query = "SELECT * FROM `events` WHERE eid = '" . $_GET['event'] . "' LIMIT 1;";
	$result=mysql_query($query);
	
	if ($title != mysql_result($result, 0, 'title')) {
		mysql_query("UPDATE `events` SET title = '" . $title . "' WHERE eid = '" . $_GET['event'] . "';");
		$content .= "Title updated, it is now " . $title . ".</br>";
	}
	if ($location != mysql_result($result, 0, 'location')) {
		mysql_query("UPDATE `events` SET location = '" . $location . "' WHERE eid = '" . $_GET['event'] . "';");
		$content .= "Location updated, it is now " . $location . ".</br>";
	}
	if ($desc != mysql_result($result, 0, 'desc')) {
		mysql_query("UPDATE `events` SET events.desc = '" . $desc . "' WHERE eid = '" . $_GET['event'] . "';");
		$content .= "Description updated, it is now '" . $desc . "'.</br>";
	}
	if ($sent_sTime != mysql_result($result, 0, 'start')) {
		mysql_query("UPDATE `events` SET start = '" . $sent_sTime . "' WHERE eid = '" . $_GET['event'] . "';");
		$content .= "Start time updated, it is now " . date('D, m-d Hi', $sent_sTime) . ".</br>";
	}
	if ($sent_eTime != mysql_result($result, 0, 'end')) {
		mysql_query("UPDATE `events` SET end = '" . $sent_eTime . "' WHERE eid = '" . $_GET['event'] . "';");
		$content .= "End time updated, it is now " . date('D, m-d Hi', $sent_eTime) . ".</br>";
	}
	if ($endreg != mysql_result($result, 0, 'end_reg')) {
		mysql_query("UPDATE `events` SET end_reg = '" . $endreg . "' WHERE eid = '" . $_GET['event'] . "';");
		$content .= "End of Registration time updated, it is now " . date('D, m-d Hi', $endreg) . ".</br>";
	}
	if ($type != mysql_result($result, 0, 'type')) {
		mysql_query("UPDATE `events` SET type = '" . $type . "' WHERE eid = '" . $_GET['event'] . "';");
		$content .= "Event type updated, it is now a ";
		if ($type == "G") {
			$content .= "game";
		} elseif ($type == "M") {
			$content .= "mission";
		} elseif ($type == "E") {
			$content .= "meeting";
		}
		$content .= ".</br>";
	}
} elseif($_GET["action"] == "" || $location == "" || $title == "") {
		if($_GET["action"] == "submit") {
			if($location == "") {
				$content .= "No location provided";
			} elseif($title == "") {
				$content .= "No title provided";
			}
		}
		
		$content .= "
		<h2>Add Event</h2><br />
		
		<form name='eventAdd' action='addEvent.php?action=submit' method='post'>
		<table>
			<tr>
				<td>Title:</td>
				<td><input type='text' name='title' size='20' value='" . $title . "'/></td>
			</tr>
			<tr>
				<td>Location:</td>
				<td><input type='text' name='location' size='20' value='" . $location . "'/></td>
			</tr>
			<tr>
				<td>Start:</td>
				<td><select name='sMonth'>";
				for($i = 0; $i < 12; $i++)
				{
					$content .= "<option value='" . ((int)$i+1) . "'";
					if ($today['mon'] == $i+1)
					{
						$content .= " selected";
					}
					$content .= ">" . $Months[$i] . "</option>";
				}
	$content .="</select><select name='sDay'>";
				for($i = 1; $i < 32; $i++)
				{
					$content .= "<option value='" . ($i) . "'";
					if ($today['mday'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select><select name='sYear'>";
				for($i = (int)$today['year']; $i < (int)$today['year']+2; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($today['year'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select></td></tr><tr><td> </td><td><select name='sHour'>";
				for($i = 0; $i < 24; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($today['hours'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select>:<select name='sMin'>";
				for($i = 0; $i < 60; $i=$i+15)
				{
					$content .= "<option value='" . $i . "'>" . $i . "</option>";
				}
	$content .="</select></td>
			</tr>
			<tr><td> </td><td> </td></tr>
			<tr>
				<td>End:</td>
				<td><select name='eMonth'>";
				for($i = 0; $i < 12; $i++)
				{
					$content .= "<option value='" . ((int)$i+1) . "'";
					if ($today['mon'] == $i+1)
					{
						$content .= " selected";
					}
					$content .= ">" . $Months[$i] . "</option>";
				}
	$content .="</select><select name='eDay'>";
				for($i = 1; $i < 32; $i++)
				{
					$content .= "<option value='" . ($i) . "'";
					if ($today['mday'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select><select name='eYear'>";
				for($i = (int)$today['year']; $i < (int)$today['year']+2; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($today['year'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select></td></tr><tr><td> </td><td><select name='eHour'>";
				for($i = 0; $i < 24; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($today['hours'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select>:<select name='eMin'>";
				for($i = 0; $i < 60; $i=$i+15)
				{
					$content .= "<option value='" . $i . "'>" . $i . "</option>";
				}
	$content .="</select></td>
			</tr>
			<tr><td> </td><td> </td></tr>
			<tr>
				<td>End of Registration:</td>
				<td><select name='rMonth'>";
				for($i = 0; $i < 12; $i++)
				{
					$content .= "<option value='" . ((int)$i+1) . "'";
					if ($today['mon'] == $i+1)
					{
						$content .= " selected";
					}
					$content .= ">" . $Months[$i] . "</option>";
				}
	$content .="</select><select name='rDay'>";
				for($i = 1; $i < 32; $i++)
				{
					$content .= "<option value='" . ($i) . "'";
					if ($today['mday'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select><select name='rYear'>";
				for($i = (int)$today['year']; $i < (int)$today['year']+2; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($today['year'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select></td></tr><tr><td>(Only used for games.)</td><td><select name='rHour'>";
				for($i = 0; $i < 24; $i++)
				{
					$content .= "<option value='" . $i . "'";
					if ($today['hours'] == $i)
					{
						$content .= " selected";
					}
					$content .= ">" . $i . "</option>";
				}
	$content .="</select>:<select name='rMin'>";
				for($i = 0; $i < 60; $i=$i+15)
				{
					$content .= "<option value='" . $i . "'>" . $i . "</option>";
				}
	$content .="</select></td>
			</tr>
			<tr><td> </td><td> </td></tr>
			<tr>
				<td>Event Type</td>
				<td>
					<select name='type'>
						<option value='E'>Meeting</option>
						<option value='M'>Mission</option>
						<option value='G'>Game</option>
					</select>
				</td>
			</tr>
			<tr><td> </td><td> </td></tr>
			<tr><td colspan='2'><textarea rows='4' cols='80' name='desc'>Description</textarea></td></tr>
			<tr><td colspan='2'><input type='Submit' value='Add Event' />
		</table>
		</form>
		";
}elseif($_GET["action"] == "submit") {
	mysql_query("INSERT INTO `events` (`title`, `desc`, `location`, `start`, `end`, `end_reg`, `type`) VALUES ('" . $title . "', '" . $desc . "', '" . $location . "', '" . $sent_sTime . "', '" . $sent_eTime . "', '" . $endreg . "', '" . $type . "')");
	$content .= "Event added successfully!";
	$head .= "<meta http-equiv='refresh' content='2; URL=events.php'>";
}

}
include("core/coreFoot.php");
?>
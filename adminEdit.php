<?php
include("core/coreHead.php");

if ($_SESSION['admin'] == 'true') {
	
	$email = mysql_real_escape_string($_POST["email"]);
	$fname = mysql_real_escape_string($_POST["fname"]);
	$lname = mysql_real_escape_string($_POST["lname"]);
	$handle = mysql_real_escape_string($_POST["handle"]);
	$rid = mysql_real_escape_string($_POST["rid"]);
	
	if($_GET["action"] == "edit") {
		$content .= "<h2>Member Edit</h2><br />";
		$query = "SELECT * FROM `members` WHERE mid = '" . $_GET['mid'] . "' LIMIT 1;";
		$result=mysql_query($query);
		$content .= "
			<form name='update' action='adminEdit.php?action=editsubmit' method='post'>
			<input type='hidden' name='mid' value='" . $_GET['mid'] . "'/>
			<table>
				<tr>
					<td>Email Address:</td>
					<td><input type='text' name='email' size='25' value='" . mysql_result($result, 0, 'email') . "'/></td>
				</tr>
				<tr>
					<td>First Name:</td>
					<td><input type='text' name='fname' size='20' value='" . mysql_result($result, 0, 'fname') . "'/></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input type='text' name='lname' size='20' value='" . mysql_result($result, 0, 'lname') . "'/></td>
				</tr>
				<tr>
					<td>Nickname:</td>
					<td><input type='text' name='handle' size='20' value='" . mysql_result($result, 0, 'handle') . "'/></td>
				</tr>
				<tr>
					<td>Res Hall:</td>
					<td>
						<select name='rid'>";
		
		$query = "SELECT * FROM `res_hall`;";
		$results=mysql_query($query);
		$numRows=mysql_numrows($results);
		
		for($i=0; $i<$numRows; $i++)
		{
			$content .= "<option value='" . mysql_result($results, $i, "rid") . "'";
			if (mysql_result($results, $i, 'rid') == mysql_result($result, 0, 'rid')) {
				$content .= " selected";
			}
			$content .= ">" . mysql_result($results, $i, "name") . "</option>";
		}
			
		$content .="
						</select>
					</td>
				</tr>
				<tr><td rowspan='2'><input type='Submit' value='Update Profile' />
			</table>
			</form>
		";
	} elseif($_GET["action"] == "editsubmit") {
		$content .= "<h2>Member Updated</h2><br />";
		
		$query = "SELECT * FROM `members` WHERE mid = '" . $_POST['mid'] . "' LIMIT 1;";
		$result=mysql_query($query);
		
		if ($email != mysql_result($result, 0, 'email')) {
			mysql_query("UPDATE `members` SET email = '" . $email . "' WHERE mid = '" . $_POST['mid'] . "';");
			$content .= "Email address updated, it is now " . $email . ".</br>";
		}
		if ($fname != mysql_result($result, 0, 'fname')) {
			mysql_query("UPDATE `members` SET fname = '" . $fname . "' WHERE mid = '" . $_POST['mid'] . "';");
			$content .= "First name updated, it is now " . $fname . ".</br>";
		}
		if ($lname != mysql_result($result, 0, 'lname')) {
			mysql_query("UPDATE `members` SET lname = '" . $lname . "' WHERE mid = '" . $_POST['mid'] . "';");
			$content .= "Last name updated, it is now " . $lname . ".</br>";
		}
		if ($handle != mysql_result($result, 0, 'handle')) {
			mysql_query("UPDATE `members` SET handle = '" . $handle . "' WHERE mid = '" . $_POST['mid'] . "';");
			$content .= "Nickname updated, it is now " . $handle . ".</br>";
		}
		if ($rid != mysql_result($result, 0, 'rid')) {
			mysql_query("UPDATE `members` SET rid = '" . $rid . "' WHERE mid = '" . $_POST['mid'] . "';");
			$content .= "Residence hall updated.</br>";
		}
		
		$head .= "<meta http-equiv='refresh' content='4; URL=roster.php'>";
	}
}

include("core/coreFoot.php");
?>
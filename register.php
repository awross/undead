<?php
include("core/coreHead.php");

$email = mysql_real_escape_string($_POST["email"]);
$username = mysql_real_escape_string($_POST["username"]);
$username = $username == "username" ? "" : $username;
$pass1 = mysql_real_escape_string($_POST["pass1"]);
$pass2 = mysql_real_escape_string($_POST["pass2"]);
$fname = mysql_real_escape_string($_POST["fname"]);
$lname = mysql_real_escape_string($_POST["lname"]);
$handle = mysql_real_escape_string($_POST["handle"]);
$phone = mysql_real_escape_string($_POST["phone"]);
$rid = mysql_real_escape_string($_POST["rid"]);
$chooseOZ = $_POST["chooseOZ"] == "on" ? 1 : 0;

if($_GET["action"] == "submit") {
	$query = "SELECT * FROM `members`;";
	$results=mysql_query($query);
	$numRows=mysql_numrows($results);
	for($i=0; $i<$numRows; $i++)
	{
		if (( mysql_result($results, $i, "fname") == $_POST["fname"] && mysql_result($results, $i, "lname") == $_POST["lname"] ) || mysql_result($results, $i, "email") == $_POST["email"])
		{
			$repeat = true;
		}
	}
}

if($_GET["action"] == "edit") {
	$content .= "<h2>Member Edit</h2><br />";
	$query = "SELECT * FROM `members` WHERE mid = '" . $_SESSION['mid'] . "' LIMIT 1;";
	$result=mysql_query($query);
$content .= "
	<form name='update' action='register.php?action=editsubmit' method='post'>
	<table>
		<tr>
			<td>Email Address:</td>
			<td><input type='text' name='email' size='25' value='" . mysql_result($result, 0, 'email') . "'/></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type='password' name='pass1' size='20' value='" . mysql_result($result, 0, 'password') . "'/></td>
		</tr>
		<tr>
			<td>Retype:</td>
			<td><input type='password' name='pass2' size='20' value='" . mysql_result($result, 0, 'password') . "'/></td>
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
			<td>Phone Number:</td>
			<td><input type='text' name='phone' size='20' value='" . mysql_result($result, 0, 'phone') . "'/></td>
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
		<tr>
			<td>Original Zombie?:</td>
			<td><input type='checkbox' name='chooseOZ'";
			if ((int)mysql_result($result, 0, 'prefer_oz') > 0) {
				$content .= " checked";
			}
			$content .= " /></td>
		</tr>
		<tr><td rowspan='2'><input type='Submit' value='Update Profile' />
	</table>
	</form>
";
} elseif($_GET["action"] == "editsubmit") {
	$content .= "<h2>Member Updated</h2><br />";
	
	$query = "SELECT * FROM `members` WHERE mid = '" . $_SESSION['mid'] . "' LIMIT 1;";
	$result=mysql_query($query);
	if (mysql_numrows($result)) {
		if ($email != mysql_result($result, 0, 'email') && $email != '') {
			mysql_query("UPDATE `members` SET email = '" . $email . "' WHERE mid = '" . $_SESSION['mid'] . "';");
			$content .= "Email address updated, it is now " . $email . ".</br>";
		}
		if ($fname != mysql_result($result, 0, 'fname')) {
			mysql_query("UPDATE `members` SET fname = '" . $fname . "' WHERE mid = '" . $_SESSION['mid'] . "';");
			$content .= "First name updated, it is now " . $fname . ".</br>";
		}
		if ($lname != mysql_result($result, 0, 'lname')) {
			mysql_query("UPDATE `members` SET lname = '" . $lname . "' WHERE mid = '" . $_SESSION['mid'] . "';");
			$content .= "Last name updated, it is now " . $lname . ".</br>";
		}
		if ($pass1 != mysql_result($result, 0, 'password') && $pass1 == $pass2 && $pass1 != '') {
			mysql_query("UPDATE `members` SET password = '" . $pass1 . "' WHERE mid = '" . $_SESSION['mid'] . "';");
			$content .= "Password updated.</br>";
		} elseif ($pass1 != $pass2) {
			$content .= "Passwords did not match, they were not changed.</br>";
		}
		if ($handle != mysql_result($result, 0, 'handle')) {
			mysql_query("UPDATE `members` SET handle = '" . $handle . "' WHERE mid = '" . $_SESSION['mid'] . "';");
			$content .= "Nickname updated, it is now " . $handle . ".</br>";
		}
		if ($phone != mysql_result($result, 0, 'phone')) {
			mysql_query("UPDATE `members` SET phone = '" . $phone . "' WHERE mid = '" . $_SESSION['mid'] . "';");
			$content .= "Phone Number updated, it is now " . $phone . ".</br>";
		}
		if ($rid != mysql_result($result, 0, 'rid')) {
			mysql_query("UPDATE `members` SET rid = '" . $rid . "' WHERE mid = '" . $_SESSION['mid'] . "';");
			$content .= "Residence hall updated.</br>";
		}
		if ($chooseOZ != mysql_result($result, 0, 'prefer_oz')) {
			mysql_query("UPDATE `members` SET prefer_oz = '" . $chooseOZ . "' WHERE mid = '" . $_SESSION['mid'] . "';");
			$content .= "Original Zombie preference updated.</br>";
		}
	}
}elseif($_GET["action"] == "" || $email == "" || $fname == "" || $lname == "" || $handle == "" || $pass1 != $pass2 || $repeat) {
	if($_GET["action"] == "submit") {
		if($fname == "" || $lname == "" || $handle == "") {
			$content .= "Not all information entered.<br />";
		} elseif($pass1 != $pass2) {
			$content .= "Passwords don't match.";
		} elseif($repeat) {
			$content .= "You have already registered with this organization.";
		}
	}
	$content .= "
	<h2>Member Registration</h2><br />
	
	<form name='register' action='register.php?action=submit' method='post'>
	<table>
		<tr>
			<td>Email Address:</td>
			<td><input type='text' name='email' size='25' value='" . $email . "'/></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type='password' name='pass1' size='20' value='" . $pass1 . "'/></td>
		</tr>
		<tr>
			<td>Retype:</td>
			<td><input type='password' name='pass2' size='20' value='" . $pass2 . "'/></td>
		</tr>
		<tr>
			<td>First Name:</td>
			<td><input type='text' name='fname' size='20' value='" . $fname . "'/></td>
		</tr>
		<tr>
			<td>Last Name:</td>
			<td><input type='text' name='lname' size='20' value='" . $lname . "'/></td>
		</tr>
		<tr>
			<td>Nickname:</td>
			<td><input type='text' name='handle' size='20' value='" . $handle . "'/></td>
		</tr>
		<tr>
			<td>Phone Number:</td>
			<td><input type='text' name='phone' size='20' value='" . $phone . "'/></td>
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
		$content .= "<option value='" . mysql_result($results, $i, "rid") . "'>" . mysql_result($results, $i, "name") . "</option>";
	}
		
	$content .="
				</select>
			</td>
		</tr>
		<tr>
			<td>Original Zombie?:</td>
			<td><input type='checkbox' name='chooseOZ' /></td>
		</tr>
		<tr><td rowspan='2'><input type='Submit' value='Register' />
	</table>
	</form>
	";
} elseif($_GET["action"] == "submit") {
	$content .= "<h2>Member Registration</h2><br />";
	$chooseOZ = $_POST["chooseOZ"] == "on" ? 1 : 0;
	$sql = "INSERT INTO `members` (email, username, password, fname, lname, handle, phone, rid, prefer_oz) VALUES ('" . $email . "', 'none', '" . $pass1 . "', '" . $fname . "', '" . $lname . "', '" . $handle . "', '" . $phone . "', '" . $rid . "', '" . $chooseOZ . "');";
	mysql_query($sql);
	//$content .= $sql;
	$content .= "Registered successfully!";
	$head .= "<meta http-equiv='refresh' content='5; URL=index.php'>";
}
include("core/coreFoot.php");
?>
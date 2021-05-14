<?php
include("core/coreHead.php");
if ($_SESSION['admin'] == 'true') {
	if($_GET['action'] == 'edit') {
		$result = mysql_query("SELECT * FROM `res_hall` WHERE rid = '" . $_GET['rid'] . "' LIMIT 1;");
		
		$content .= "
			<h2>Edit Res</h2><br />
			<form action='addDorm.php?action=editsubmit&rid=" . $_GET['rid'] . "' method='post'>
			<table>
				<tr><td>Hall Name</td><td><input type='text' size='25' name='hall' value='" . mysql_result($result, 0, 'name') . "' /></td></tr>
				<tr><td>Clan Name</td><td><input type='text' size='25' name='clan' value='" . mysql_result($result, 0, 'clan') . "' /></td></tr>
				<tr><td><input type='submit' value='Edit Res Hall' /></td><td> </td></tr>
			</table>
			</form>
		";
	} elseif ($_GET['action'] == 'editsubmit') {	
		$result = mysql_query("SELECT * FROM `res_hall` WHERE rid = '" . $_GET['rid'] . "' LIMIT 1;");
		
		if ($_POST['hall'] != mysql_result($result, 0, 'name')) {
			mysql_query("UPDATE `res_hall` SET name = '" . $_POST['hall'] . "' WHERE rid = '" . $_GET['rid'] . "';");
			$content .= "Hall name updated, it is now " . $_POST['hall'] . ".</br>";
		}
		if ($_POST['clan'] != mysql_result($result, 0, 'clan')) {
			mysql_query("UPDATE `res_hall` SET clan = '" . $_POST['clan'] . "' WHERE rid = '" . $_GET['rid'] . "';");
			$content .= "Clan name updated, it is now " . $_POST['clan'] . ".</br>";
		}
		
		$head .= "<meta http-equiv='refresh' content='2; URL=dorms.php'>";
	} elseif ($_GET['action'] == '' || $_POST['hall'] == '' || $_POST['clan'] == '') {
		$result = mysql_query("SELECT * FROM `res_hall` WHERE rid = '" . $_GET['rid'] . "' LIMIT 1;");
		
		$content .= "
			<h2>Add Res</h2><br />
			<form action='addDorm.php?action=submit' method='post'>
			<table>
				<tr><td>Hall Name</td><td><input type='text' name='hall' size='25' name='name' value='" . $_POST['hall'] . "' /></td></tr>
				<tr><td>Clan Name</td><td><input type='text' name='clan' size='25' name='clan' value='" . $_POST['clan'] . "' /></td></tr>
				<tr><td><input type='submit' value='Add Res Hall' /></td><td> </td></tr>
			</table>
			</form>
		";
	} elseif ($_GET['action'] == 'submit' && $_POST['hall'] != '' && $_POST['clan'] != '') {
		mysql_query("INSERT INTO `res_hall` (name, clan) VALUES ('" . $_POST['hall'] . "', '" . $_POST['clan'] . "');");
		
		$content .= "Added successfully!";
		$head .= "<meta http-equiv='refresh' content='2; URL=dorms.php'>";
	}
}
include("core/coreFoot.php");
?>
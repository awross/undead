<?php
include("core/coreHead.php");

if ($_SESSION['admin'] == 'true') {
	$results = mysql_query("SELECT * FROM `members` WHERE mid = '" . $_GET['mid'] . "' LIMIT 1;");
	if (mysql_result($results, 0, 'admin') > 0) {
		mysql_query("UPDATE `members` SET admin = '0' WHERE mid = '" . $_GET['mid'] . "' LIMIT 1;");
	} else {
		mysql_query("UPDATE `members` SET admin = '1' WHERE mid = '" . $_GET['mid'] . "' LIMIT 1;");
	}
	
	header('Location: roster.php');
}

include("core/coreFoot.php");
?>
<?php
include("core/coreHead.php");

if ($_SESSION['admin'] == 'true') {
	mysql_query("DELETE FROM `res_hall` WHERE rid = '" . $_GET['rid'] . "';");
	
	mysql_query("UPDATE `members` SET rid = '0' WHERE rid = '" . $_GET['rid'] . "';");
	
	$content .= "Residence hall deleted.";
	$head .= "<meta http-equiv='refresh' content='2; URL=dorms.php'>";
}

include("core/coreFoot.php");
?>
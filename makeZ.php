<?php
include("core/coreHead.php");

if($_SESSION['admin'] == 'true') {

	mysql_query("DELETE FROM `game_op` WHERE eid = '" . $_GET['eid'] . "' AND mid = '" . $_GET['mid'] . "';");

	mysql_query("INSERT INTO `game_op` (eid, mid, status, timeofdeath, killed_by) VALUES ('" . $_GET['eid'] . "', '" . $_GET['mid'] . "', 'Z', '" . time() . "', '0');");

	header('Location: editCurgame.php');
	
} else {
	header('Location: curgame.php');
}

include("core/coreFoot.php");
?>
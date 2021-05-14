<?php
include("core/coreHead.php");

if($_SESSION['admin'] == 'true') {

	mysql_query("UPDATE `game_op` SET active = '0' WHERE eid = '" . $_GET['eid'] . "' AND mid = '" . $_GET['mid'] . "';");
	
	header('Location: editCurgame.php');
	
} else {
	header('Location: curgame.php');
}

include("core/coreFoot.php");
?>
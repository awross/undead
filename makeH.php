<?php
include("core/coreHead.php");

if($_SESSION['admin'] == 'true') {

	mysql_query("DELETE FROM `game_op` WHERE eid = '" . $_GET['eid'] . "' AND mid = '" . $_GET['mid'] . "';");

	$len = 8;
	$base='ABCDEFGHKLMNOPQRSTWXYZ345789';
	$max=strlen($base)-1;
			
	$killcode='';
	mt_srand((double)microtime()*1000000);
	while (strlen($killcode)<$len) {
		$killcode.=$base{mt_rand(0,$max)};
	}
	
	mysql_query("INSERT INTO `game_op` (eid, mid, killcode) VALUES ('" . $_GET['eid'] . "', '" . $_GET['mid'] . "', '" . $killcode . "');");
	
	header('Location: editCurgame.php');
	
} else {
	header('Location: curgame.php');
}

include("core/coreFoot.php");
?>
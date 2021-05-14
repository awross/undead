<?php
include("core/coreHead.php");

if($_SESSION['admin'] == 'true') {

	$len = 7;
	$base='ABCDEFGHKLMNOPQRSTWXYZ345789';
	$max=strlen($base)-1;
		
	$repeat = true;
	while ($repeat) {
		$foodcode='#';
		mt_srand((double)microtime()*1000000);
		while (strlen($foodcode)<$len) {
			$foodcode.=$base{mt_rand(0,$max)};
		}
		
		$num = mysql_num_rows(mysql_query("SELECT * FROM `zombie_food` WHERE foodcode = '" . $foodcode . "';"));
		$repeat = $num > 0;
	}

	mysql_query("INSERT INTO `zombie_food` (eid, foodcode, eaten_by, time_eaten) VALUES ('" . $_GET['eid'] . "', '" . $foodcode . "', '" . $_GET['mid'] . "', '" . time() . "');");
	
	mysql_query("UPDATE `game_op` SET active = '1' WHERE eid = '" . $_GET['eid'] . "' AND mid = '" . $_GET['mid'] . "';");

	header('Location: editCurgame.php');
	
} else {
	header('Location: curgame.php');
}

include("core/coreFoot.php");
?>
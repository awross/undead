<?php
include("core/coreHead.php");

if ($_SESSION['admin'] == 'true') {
	mysql_query("INSERT INTO `event_roster` (eid, mid) VALUES ('" . $_GET['eid'] . "', '" . $_GET['mid'] . "');");

	$len = 8;
	$base='ABCDEFGHKLMNOPQRSTWXYZ345789';
	$max=strlen($base)-1;
			
	$repeat = true;
	while ($repeat) {
		$killcode='';
		mt_srand((double)microtime()*1000000);
		while (strlen($killcode)<$len) {
			$killcode.=$base{mt_rand(0,$max)};
		}
		
		$num = mysql_num_rows(mysql_query("SELECT * FROM `game_op` WHERE killcode = '" . $killcode . "';"));
		
		$repeat = $num > 0;
	}
	
	mysql_query("INSERT INTO `game_op` (eid, mid, killcode) VALUES ('" . $_GET['eid'] . "', '" . $_GET['mid'] . "', '" . $killcode . "');");
	
	header('Location: roster.php');
}

include("core/coreFoot.php");
?>
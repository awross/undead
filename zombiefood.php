<?php
include("core/coreHead.php");
if ($_SESSION['admin'] == 'true') {
	$query = "SELECT * FROM `events` WHERE end > '" . time() . "' AND type = 'G' ORDER BY start LIMIT 1;";
	$result=mysql_query($query);
	
	$content .= "<h2>Adding Food For " . mysql_result($result, 0, 'title') . "</h2>";
	
	if($_GET['action'] != "add") {
		$content .= "
		<form action='zombiefood.php?action=add' method='post'>
		<table>
			<tr>
				<td>Number of meals to prepare:</td>
				<td><select name='meals'>";
				
				for($i=1; $i<31; $i++) {
					$content .= "<option value='" . $i . "'>" . $i . "</option>";
				}
				
		$content .= "
				</select></td>
				<td><input type='submit' value='Get Cooking!' /></td>
			</tr>
		</table>
		</form>
		";
	} else {
		$content .= "<h2><small>Codes:</small></h2>";
		
		$len = 7;
		$base='ABCDEFGHKLMNOPQRSTWXYZ345789';
		$max=strlen($base)-1;
			
		for($i=0; $i<(int)$_POST['meals']; $i++) {
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
			
			$content .= $foodcode . "<br />";
			mysql_query("INSERT INTO `zombie_food` (eid, foodcode) VALUES ('" . mysql_result($result, 0, 'eid') . "', '" . $foodcode . "');");
			$foodcode = "";
		} 
	}
}
include("core/coreFoot.php");
?>
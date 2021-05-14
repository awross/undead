<?php
include("core/coreHead.php");
$head .= <<<HEAD
		<style type="text/css">
		html,body {
		  height: 100%;
		  margin: 0;
		  padding: 0;
		}
		#outerMost {
		  position: relative;
		  min-height: 100%;
		}
		
		p { /* to prevent collapsing margins from interfering with this demo */
		  margin: 0;
		  padding: .5em;
		}
		
		#greyOutPage {
		  position: absolute; /* for IE5-6 */
		  z-index: 9000;
		  left: 0;
		  right: 0;
		  top: 0;
		  bottom: 0;
		  background-color: #666;
		  filter:alpha(opacity=50); /* IE5.5+ */
		  -moz-opacity:0.8; /* Gecko browsers including Netscape 6+ and Firefox */
		  -khtml-opacity: 0.5; /* Safari 1.1-1.3 */
		  opacity: 0.5; /* Netscape 7.2+, Firefox, Safari 2+, Opera 9 */
		}
		/* Hide from IE5/Mac \*/
		* html #outerMost {
		  height: 100%;
		}
		* html #greyOutPage {
		  left: auto;
		  top: auto;
		  width: 200%;
		  height: 200%;
		}
		/* End hide */
		#popup {
			position: absolute;
			top: 150px;
			left: 150px;
			z-index: 9001;
			background-color: white;
			padding: 20px;
		}
		.content .closeButton {
			position: absolute;
			bottom: 20px;
			right: 50px;
		}
		.popup .content {
			position: relative;
		}
		</style>
		<script type="text/javascript">
			function showMap(){
				document.getElementById("popup").style.display = "";
				document.getElementById("greyOutPage").style.display = "";
			}
			function hideMap(){
				document.getElementById("popup").style.display = "none";
				document.getElementById("greyOutPage").style.display = "none";
			}
		</script>
HEAD;

$OZhideTime = (12*60*60);
$ZDeathTime = (3*24*60*60);

$query = "SELECT * FROM `events` WHERE end > '" . time() . "' AND type = 'G' ORDER BY start LIMIT 1;";
$result = mysql_query($query);
$sTime = mysql_result($result, 0, 'start');
$eTime = mysql_result($result, 0, 'end');

// For After Unveiling
/* $query = "SELECT game_op.mid, game_op.status, game_op.timeofdeath, game_op.killed_by, members.fname, members.lname, members.handle, members.rid, res_hall.clan FROM `game_op` LEFT JOIN `members` ON game_op.mid = members.mid LEFT JOIN `res_hall` ON members.rid = res_hall.rid WHERE game_op.eid = '" . mysql_result($result, 0, 'eid') . "' AND game_op.active = '1' ORDER BY game_op.timeofdeath DESC, res_hall.clan DESC, members.lname ASC;"; */

// For Before Unveiling
 $query = "SELECT game_op.mid, game_op.status, game_op.timeofdeath, game_op.killed_by, members.fname, members.lname, members.handle, members.rid, res_hall.clan FROM `game_op` LEFT JOIN `members` ON game_op.mid = members.mid LEFT JOIN `res_hall` ON members.rid = res_hall.rid WHERE game_op.eid = '" . mysql_result($result, 0, 'eid') . "' AND game_op.active = '1' ORDER BY res_hall.clan DESC, members.lname ASC;";

$results=mysql_query($query);
$numRows=mysql_numrows($results);

$CU = mysql_query("SELECT * FROM `game_op` WHERE eid = '" . mysql_result($result, 0, 'eid') . "' AND mid = '" . $_SESSION["mid"] . "';");
$num_CU = mysql_numrows($CU);

if ($num_CU > 0 && mysql_result($CU, 0, 'status') != "H") {
	$sidebar .= "
		<form name='feed' action='reportKill.php?event=" . mysql_result($result, 0, 'eid') . "' method='post'>
			<table><tr><td>Report Kill:</td><td><input name='code' type='text' size='8' /></td></tr><tr><td colspan='2' align='right'><a href='#' onclick='showMap();return(false);'>Bite!</a></td><!--<td><a href='javascript:void' onclick='document.feed.submit();'>Food!</a></td>--></tr></table>
	";
}

$content .= "
<div id='post'>
	<div id='title'>
		<h2>" . mysql_result($result, 0, 'title') . "</h2>
		<table>
			<tr><td width='120px'><small>Starts:</td><td>" . date('D, m-d Hi', $sTime) . "</small></td></tr>
			<tr><td><small>Ends:</td><td>" . date('D, m-d Hi', $eTime) . "</small></td></tr>
			<tr><td><small>Location:</td><td>" . mysql_result($result, 0, 'location') . "</small></td></tr>
			<tr><td colspan='2' align='center'><a href='curGraph.php?event=" . mysql_result($result, 0, 'eid') . "'>Graphs</a></small></td></tr>
		</table>
	</div>
</div>
<br /><br />
";
$Human = "
<center><h2>Resistance</h2></center>
<table width='700px'>
	<thead>
	<tr>
		<th> </th>
		<th align='left'>Handle</th>
		<th align='left'>Name</th>
		<th align='left'>Clan</th>
	</tr>
	</thead>
	<tbody>
";
$Zombie = "
<center><h2>Undead</h2></center>
<table width='700px'>
	<thead>
	<tr>
		<th> </th>
		<th align='left'>Handle</th>
		<th align='left'>Name</th>
		<th align='left'>Time of Undeath</th>
		<th align='left'>Bites</th>
		<th align='left'>Bitten By</th>
		<th align='left'>Status</th>
	</tr>
	</thead>
	<tbody>
";

$numH = 0;
$numZf = 0;
$numZh = 0;
$numZs = 0;

for($i = 0; $i < $numRows; $i++) {
	$query = "SELECT * FROM `game_op` WHERE killed_by = '" . mysql_result($results, $i, "mid") . "' AND eid = '" . mysql_result($result, 0, 'eid') . "' ORDER BY timeofdeath DESC;";
	$bitesQ = mysql_query($query);
	$bites = mysql_numrows($bitesQ);
	
	if (mysql_result($results, $i, "status") == "H" || ( (mysql_result($results, $i, "status") == "OZ" && time() < $sTime+$OZhideTime) && (mysql_result($results, $i, "status") == "OZ" && $bites < 5) )) {
		$handle = mysql_result($results, $i, "mid") == $_SESSION["mid"] ? "<strong><u>" . mysql_result($results, $i, "handle") . "</u></strong>" : mysql_result($results, $i, "handle");
		
		$numH++;
		$Human .= "
			<tr>
				<td>" . $numH . "</td>
				<td>" . $handle . "</td>
				<td>" . mysql_result($results, $i, "lname") . ", " . mysql_result($results, $i, "fname") . "</td>
				<td>" . mysql_result($results, $i, "clan") . "</td>
			</tr>
		";
	} else {
		$query = "SELECT * FROM `members` WHERE mid = '" . mysql_result($results, $i, "killed_by") . "' LIMIT 1;";
		$biter=mysql_query($query);
		
		$handle = mysql_result($results, $i, "mid") == $_SESSION["mid"] ? "<strong><u>" . mysql_result($results, $i, "handle") . "</u></strong>" : mysql_result($results, $i, "handle");

		$query = "SELECT * FROM `zombie_food` WHERE eid = '" . mysql_result($result, 0, 'eid') . "' AND eaten_by = '" . mysql_result($results, $i, "mid") . "' ORDER BY time_eaten DESC;";
		$food = mysql_query($query);
		
		$lastF = (mysql_num_rows($food) > 0) ? mysql_result($food, 0, 'time_eaten') : 0;
		$lastK = $bites>0 ? (int)mysql_result($bitesQ, 0, 'timeofdeath') : 0;
		$lastMeal = ($lastF > $lastK) ? $lastF : $lastK;
		$sinceFood = $lastMeal > mysql_result($results, $i, "timeofdeath") ? time() - $lastMeal : time() - (int)mysql_result($results, $i, "timeofdeath");
        
        if ($sinceFood >= $ZDeathTime) {
			mysql_query("UPDATE `game_op` SET active = '0' WHERE eid = '" . mysql_result($result, 0, 'eid') . "' AND mid = '" . mysql_result($results, $i, "mid") . "';");
		}
        
		if ($sinceFood < ($ZDeathTime/3))
		{
			$numZf++;
			
			$FINE .= "
			<tr>
			<td>" . $numZf . "</td>
			<td>" . $handle . "</td>
			<td>" . mysql_result($results, $i, "lname") . ", " . mysql_result($results, $i, "fname") . "</td>
			<td>" . date("D, m-d Hi", mysql_result($results, $i, "timeofdeath")) . "</td>
			<td>" . $bites . "</td>
			";
			
			if ( (mysql_result($results, $i, "status") == "Z") && (time() >= ($sTime+$OZhideTime)) )
			{
				$FINE .= "<td>" . mysql_result($biter, 0, "handle") . "</td>";
			}
			else
			{
				$$FINE .= "<td>-</td>";
			}
			
			$FINE .= "<td>Fine</td></tr>";
		}
		elseif ($sinceFood > (2*$ZDeathTime/3))
		{
			$numZs++;
			$STARVE .= "
			<tr>
			<td>" . $numZs . "</td>
			<td>" . $handle . "</td>
			<td>" . mysql_result($results, $i, "lname") . ", " . mysql_result($results, $i, "fname") . "</td>
			<td>" . date("D, m-d Hi", mysql_result($results, $i, "timeofdeath")) . "</td>
			<td>" . $bites . "</td>
			";
			
			if ( (mysql_result($results, $i, "status") == "Z") && (time() >= ($sTime+$OZhideTime)) )
			{
				$STARVE .= "<td>" . mysql_result($biter, 0, "handle") . "</td>";
			}
			else
			{
				$STARVE .= "<td>-</td>";
			}
			
			$STARVE .= "<td>Starving</td></tr>";
		}
		else
		{
			$numZh++;
			
			$HUNGRY .= "
			<tr>
			<td>" . $numZh . "</td>
			<td>" . $handle . "</td>
			<td>" . mysql_result($results, $i, "lname") . ", " . mysql_result($results, $i, "fname") . "</td>
			<td>" . date("D, m-d Hi", mysql_result($results, $i, "timeofdeath")) . "</td>
			<td>" . $bites . "</td>
			";
			
			if ( (mysql_result($results, $i, "status") == "Z") && (time() >= ($sTime+$OZhideTime)) )
			{
				$HUNGRY .= "<td>" . mysql_result($biter, 0, "handle") . "</td>";
			}
			else
			{
				$HUNGRY .= "<td>-</td>";
			}
			
			$HUNGRY .= "<td>Hungry</td></tr>";
		}
	}
}

$Human .= "</tbody></table>";

$Zombie .= $FINE . $HUNGRY . $STARVE . "<tr><td> </td><td>Total: " . ($numZh + $numZs + $numZf) . "</td></tr></tbody></table>";
$Inactive = "";

$query = "SELECT game_op.mid, game_op.status, game_op.timeofdeath, game_op.killed_by, members.fname, members.lname, members.handle, members.rid, res_hall.clan FROM  `game_op` LEFT JOIN  `members` ON game_op.mid = members.mid LEFT JOIN  `res_hall` ON members.rid = res_hall.rid WHERE game_op.eid =  '" . mysql_result($result, 0, 'eid') . "' AND game_op.active =  '0' ORDER BY  `members`.`lname` ASC;";

$results=mysql_query($query);
$numRows=mysql_numrows($results);

if ($numRows > 0) {
    
    $Inactive .= "
    <center><h2>Inactive</h2></center>
    <table width='700px'>
        <thead>
        <tr>
            <th> </th>
            <th align='left'>Handle</th>
            <th align='left'>Name</th>
        </tr>
        </thead>
        <tbody>
    ";

    for($i = 0; $i < $numRows; $i++) {
        $handle = mysql_result($results, $i, "mid") == $_SESSION["mid"] ? "<strong><u>" . mysql_result($results, $i, "handle") . "</u></strong>" : mysql_result($results, $i, "handle");
        
        $Inactive .= "
            <tr>
                <td>" . ($i+1) . "</td>
                <td>" . $handle . "</td>
                <td>" . mysql_result($results, $i, "lname") . ", " . mysql_result($results, $i, "fname") . "</td>
            </tr>
        ";
    }
    $Inactive .= "
    	</tbody>
        </table>
    ";
}

$content .= $Human . $Zombie . $Inactive;	
    
$footer .= <<<FOOT
		<div id="greyOutPage" style="display: none; cursor: pointer;" onclick="hideMap();"></div>
		<div id="popup" style="display: none;">
			<div class="content">
					<input type="image" src="images/newMap.jpg" style="padding: 0; margin: 0;">
				</form>
				<div style="text-align: center; margin-top: 20px;">
					Click on the map where you got your tag.
				</div>
				<div class="closeButton">
					<a href="#" onclick="hideMap(); return(false);">Close</a>
				</div>
			</div>
		</div>
FOOT;
include("core/coreFoot.php");
?>

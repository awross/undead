<?php
include("core/coreHead.php");
if ($_SESSION['admin'] == 'true') {
	$results = mysql_query("SELECT * FROM `res_hall`;");
	$numResults = mysql_num_rows($results);
	$content .= "
	<table width='500px'>
		<thead>
		<tr>
			<th> </th>
			<th align='left'>Hall</th>
			<th align='left'>Clan</th>
			<th align='left'>Edit</th>
			<th align='left'>Remove</th>
		</tr>
		</thead>
		<tbody>
	";
	for($i=0; $i<$numResults; $i++) {
	$content .= "
		<tr>
			<td>" . ($i+1) . "</td>
			<td>" . mysql_result($results, $i, 'name') . "</td>
			<td>" . mysql_result($results, $i, 'clan') . "</td>
			<td align='center'><a href='addDorm.php?action=edit&rid=" . mysql_result($results, $i, 'rid') . "'>E</a></td>
			<td align='center'><a href='delRes.php?rid=" . mysql_result($results, $i, 'rid') . "'>R</a></td>
		</tr>
	";
	}
				
	$content .= "
		</tbody>
		</table>
		<a href='addDorm.php'>Add Res Hall</a>
	";
}
include("core/coreFoot.php");
?>
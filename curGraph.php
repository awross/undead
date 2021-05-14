<?php
include("core/coreHead.php");

$content .= "
	<div class='title'>
		<h2>Game Graphs</h2>
	</div><br />
	<img src='pieGraph.php?event=" . $_GET['event'] . ".png' />
	<br /><br /><br />
	<img src='barGraph.php?event=" . $_GET['event'] . ".png' />
";

include("core/coreFoot.php");
?>
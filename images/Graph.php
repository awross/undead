<?php
include("core/coreHead.php");

$content .= "
	<h2>Graph</h2>
	<img src="curGraph.php?event=20&dummy='.now().'">
include("core/coreFoot.php");
?>
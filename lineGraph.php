<?php
include("core/coreHead.php");

include ( "jGraph/jpgraph.php");
include ("jGraph/jpgraph_bar.php");

$data = mysql_query("SELECT * FROM `game_op` WHERE eid = '" . $_GET['event'] . "' AND game_op.status = 'Z' ORDER BY timeofdeath ASC;");
$result = mysql_query("SELECT * FROM `events` WHERE eid = '" . $_GET['event'] . "' LIMIT 1;");
$num = mysql_num_rows($data);

$datay = array();
$datax = array();

$time = getdate(time());
$toUse2 = gmmktime(10, 0, 0, $time['mon'], $time['mday'], $time['year']);
$toUse = $toUse2 - 86400;

for ($i=7; $i<24; $i++) {
	$newNum = mysql_num_rows(mysql_query("SELECT * FROM `game_op` WHERE eid = '" . $_GET['event'] . "' AND game_op.status = 'Z' AND timeofdeath >= '" . $toUse . "' AND timeofdeath < '" . ($toUse+3600) . "';"));
	array_push($datay, $newNum);
	array_push($datax, $i);
	$toUse += 3600;
}

// Create the graph. These two calls are always required
$graph = new Graph(600,400,"auto");    
$graph->SetScale("linlin");

// Add a drop shadow
$graph->SetShadow();

// Adjust the margin a bit to make more room for titles
$graph->img->SetMargin(40,30,20,40);

// Create a bar pot
$bplot = new BarPlot($datay, $datax);

// Setup values
$bplot->value->Show();
$bplot->value->SetFormat('%d');
$bplot->value->SetFont(FF_FONT1,FS_BOLD);
$bplot->SetValuePos('center');

// Adjust fill color
$bplot->SetFillColor('orange');
$graph->Add($bplot);

// Setup the titles
$graph->title->Set("Turns Per Hour, " . date('D, m-d', $toUse2-86400));
$graph->xaxis->title->Set("Hour");
$graph->yaxis->title->Set("Turns");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph
$graph->Stroke();


include("core/coreFoot.php");
?>
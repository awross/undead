<?php
include("core/coreHead.php");

include ( "jGraph/jpgraph.php");
include ("jGraph/jpgraph_pie.php");
include ("jGraph/jpgraph_pie3d.php");

$human = mysql_num_rows(mysql_query("SELECT * FROM `game_op` WHERE eid = '" . $_GET['event'] . "' AND game_op.status = 'H' AND active='1';"));
$zombie = mysql_num_rows(mysql_query("SELECT * FROM `game_op` WHERE eid = '" . $_GET['event'] . "' AND game_op.status <> 'H' AND active='1';"));
$Inactive = mysql_num_rows(mysql_query("SELECT * FROM `game_op` WHERE eid = '" . $_GET['event'] . "' AND active='0';"));

$data  = array($human, $zombie, $Inactive); 

$graph  = new PieGraph (435,459); 
$graph->SetShadow(); 

$graph->title-> Set( "H v Z"); 
$graph->SetBackgroundImage("images/log.gif",BGIMG_FILLFRAME);

$p1 = new PiePlot3d( $data); 
$p1 ->ExplodeSlice( 0);
$p1->SetSliceColors(array('orange','darkgray', 'red'));
$legends = array('Humans (%1.2f%%)', 'Zombies (%1.2f%%)', 'Inactive (%1.2f%%)');
$p1->SetLegends($legends); 

$p1->SetLabelType(PIE_VALUE_PER); 
$lbl = array("Human\n%1.2f%%", "Zombies\n%1.2f%%", "Inactive\n%1.2f%%"); 
$p1->SetLabels($lbl); 
$p1->SetLabelPos(0.6); 

$graph->Add( $p1); 
$graph->Stroke(); 

include("core/coreFoot.php");
?>
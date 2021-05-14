<?php header ("Content-type: image/png");
include ( "jGraph/jpgraph.php"); 
include ("jGraph/jpgraph_pie.php");
include ("jGraph/jpgraph_pie3d.php");

mysql_connect(localhost, "root", "marvin17");
@mysql_select_db("undead") or die( "Unable to select database");

$human = mysql_num_rows(mysql_query("SELECT * FROM `game_op` WHERE eid = '" . $_GET['event'] . "' AND status = 'H';"));

$zombie = mysql_num_rows(mysql_query("SELECT * FROM `game_op` WHERE eid = '" . $_GET['event'] . "' AND status <> 'H';"));

$data  = array($human, $zombie); 

$graph  = new PieGraph (300,300); 
$graph->SetShadow(); 

$graph->title-> Set( "Humans and Zombies"); 

$p1 = new PiePlot3d( $data);
$p1->SetSliceColors(array('orange', 'black')); 
$graph->Add( $p1); 
$handle = $graph->Stroke(map.jpg); 
/*
$bg_color = ImageColorAllocate ($handle, 255, 0, 0);
$txt_color = ImageColorAllocate ($handle, 0, 0, 0);
ImageString ($handle, 5, 5, 18, "This is a graph.", $txt_color);
ImagePng ($handle);
//$content .= "
//	<h2>Graph</h2>
//	<img src='ImagePng ($handle);' alt='This is a graph.'>
//";
*/
?>
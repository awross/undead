<?PHP
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
$content .= '<a href="#" onclick="showMap();return(false);">Show map</a>';
if(array_key_exists("x", $_REQUEST) && array_key_exists("y", $_REQUEST)){
	if($_REQUEST["x"] < 415 && $_REQUEST["x"] > 275 && $_REQUEST["y"] < 380 && $_REQUEST["y"] > 300){
		$content .= "<br />You pervert! You clicked her boobs!";
	}
	$content .= "<br />You clicked (" . $_REQUEST["x"] . ", " . $_REQUEST["y"] . ")";
}
$footer .= <<<FOOT
		<div id="greyOutPage" style="display: none; cursor: pointer;" onclick="hideMap();"></div>
		<div id="popup" style="display: none;">
			<div class="content">
				<form action="map.php" type="get" style="padding: 0; margin: 0;">
					<input type="image" src="images/map.jpg" style="padding: 0; margin: 0;">
				</form>
				<div style="text-align: center; margin-top: 20px;">
					Select the position on the map
				</div>
				<div class="closeButton">
					<a href="#" onclick="hideMap(); return(false);">Close</a>
				</div>
			</div>
		</div>
FOOT;
include("core/coreFoot.php");
?>
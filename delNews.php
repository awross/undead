<?php
include("core/coreHead.php");

if ($_SESSION['admin'] == 'true') {
	if($_GET['action'] == 'ok') {
		mysql_query("DELETE FROM `news` WHERE nid = '" . $_POST['nid'] . "';");
		
		$content .= "Article deleted.";
		$head .= "<meta http-equiv='refresh' content='2; URL=index.php'>";
	} else {
		$content .= "
			<form action=delNews.php?action=ok method='post'>
				<input type='hidden' value='" . $_GET['nid'] . "' name='nid' />
				Really Delete Article?:<br />
				<input type='submit' value='OK'/>
			</form>
		";
	}
}

include("core/coreFoot.php");
?>
<?php
include("core/coreHead.php");

if ($_SESSION['admin'] == 'true') {
	if($_GET['action'] == 'ok') {
		mysql_query("DELETE FROM `events` WHERE eid = '" . $_POST['event'] . "';");
		
		$content .= "Event deleted.";
		$head .= "<meta http-equiv='refresh' content='2; URL=events.php'>";
	} else {
		$content .= "
			<form action=delEvent.php?action=ok method='post'>
				<input type='hidden' value='" . $_GET['event'] . "' name='event' />
				Really Delete Event?:<br />
				<input type='submit' value='OK'/>
			</form>
		";
	}
}

include("core/coreFoot.php");
?>